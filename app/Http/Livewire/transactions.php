<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Transaction;
use App\Models\Type;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class Transactions extends Component
{
    use Actions;

    public $types;

    public $tags;

    public $categories;

    public $amount;

    public $recipient;

    public $description;

    public $tag;

    public $type;

    public $category;

    public Account $account;

    public $date;

    public $time;

    public $showForm = false;

    protected $listeners = ['deleteTransaction' => 'deleteRequest'];

    protected $rules = [
        'amount' => ['required', 'numeric'],
        'recipient' => ['required', 'string', 'max:128'],
        'description' => ['required', 'string', 'max:128'],
        'date' => ['required', 'string'],
        'time' => ['required', 'string'],
        'type' => ['required', 'numeric', 'integer'],
        'category' => ['nullable', 'numeric', 'integer'],
        'tag' => ['nullable', 'numeric', 'integer'],
    ];

    public function mount(Account $account)
    {
        $this->account = $account;
        $now = now();
        $this->date = $now->format('Y-m-d');
        $this->time = $now->format('h:i');
        $this->types = Type::all();
        $this->categories = Category::all();
        $this->tags = Tag::all();
    }

    public function updatedAmount()
    {
        $this->validateOnly('amount');
        $this->types = Type::all();
        if ($this->amount < 0) {
            $this->types = $this->types->except(Type::find(1)->id);
        } else {
            $this->types = $this->types->except(Type::find(2)->id);
        }
    }

    public function createTransaction()
    {
        $this->validate();
        $trans = Transaction::create([
            'amount' => $this->amount,
            'recipient' => $this->recipient,
            'message' => $this->description,
            'tag_id' => $this->tag,
            'type_id' => $this->type,
            'category_id' => $this->category,
            'date' => Carbon::createMidnightDate($this->date)->setTimeFromTimeString($this->time),
            'account_id' => $this->account->id,
        ]);
        $this->close();
        sleep(1);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['amount', 'recipient', 'description', 'tag', 'type', 'category']);
    }

    public function deleteRequest($params)
    {
        $transaction = Transaction::findOrFail($params)->first();
        $this->dialog()->confirm([
            'title' => 'Delete transaction: '.$transaction->id.'?',
            'description' => 'deleting the transaction is irreversible',
            'acceptLabel' => 'Yes, delete it',
            'accept' => [
                'label' => 'Yes, delete everything',
                'method' => 'deleteTransaction',
                'params' => $transaction,
            ],
            'reject' => [
                'label' => 'No, cancel',
                'method' => 'cancelDelete',
            ],
        ]);
    }

    public function deleteTransaction(Transaction $transaction)
    {
        $transaction->delete();
        $this->notification()->success(
            $title = 'Transaction:'.$transaction->id.' deleted',
            $description = 'Your transaction is deleted'
        );
        $this->emit('transactionDeleted');
    }

    public function cancelDelete()
    {
        $this->notification()->warning(
            $title = 'Action canceled',
            $description = 'the transaction was not deleted'
        );
    }

    public function close()
    {
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.transactions');
    }
}
