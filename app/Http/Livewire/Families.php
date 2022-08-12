<?php

namespace App\Http\Livewire;

use App\Models\Family;
use App\Models\User;
use App\Notifications\InviteFamilyMember;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;
use WireUi\Traits\Actions;

class Families extends Component
{
    use Actions;

    public ?Family $family;
    public ?string $email = null;
    public ?Collection $invites = null;

    protected $rules = [
        'email' => ['required', 'email'],
    ];

    public function mount(): void
    {
        $this->family = auth()->user()->family;
        $this->getNotifications();
    }

    public function getNotifications()
    {
        $this->invites = auth()->user()->notifications()
            ->where('type', 'App\Notifications\InviteFamilyMember')
            ->orderby('data')
            ->get();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.families');
    }

    public function updated($email)
    {
        $this->validateOnly($email);
    }

    public function inviteMember()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();
        if ($user) {
            if (count($user->notifications->where('data', ['familyId' => $this->family->id]))) {
                $this->notification()->error(
                    $title = 'User already invited',
                    $description = 'the user already has an invitation to join your family',
                );
                $error = true;
            } else {
                $user->notify(new InviteFamilyMember($this->family->id));
            }
        }
        if (!isset($error)) {
            $this->notification()->success(
                $title = 'Invite send',
                $description = 'an invite to join the family was send,
            if the user does not have an account please ask them to make an account first',
            );
        }
    }

    public function deleteNotification(DatabaseNotification $invite)
    {
        $invite->delete();
        $this->mount();

        $this->notification()->success(
            $title = 'Notification deleted',
            $description = 'the notification was deleted',
        );
    }

    public function joinFamily(DatabaseNotification $invite)
    {
        $user = auth()->user();
        if ($user->family !== null) {
            $this->notification()->error(
                $title = 'Cannot join other family',
                $description = 'you must leave your current family first'
            );
        } else {
            $familyId = $invite['data']['familyId'];
            $family = Family::findOrFail($familyId);

            $user->family()->associate($family);
            $user->save();
            foreach ($user->accounts as $account) {
                $account->family()->associate($family);
                $account->save();
            }
            $invite->delete();
            $this->mount();

            $this->notification()->success(
                $title = 'Joined Family',
                $description = 'All your accounts were added, change it by editing the account',
            );
        }


    }
}
