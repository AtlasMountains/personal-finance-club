<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use NumberFormatter;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\Rules\Rule;
use PowerComponents\LivewirePowerGrid\Rules\RuleActions;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use WireUi\Traits\Actions;

final class TransactionsTable extends PowerGridComponent
{
    use Actions;
    use ActionButton;

    public $account;

    public string $primaryKey = 'transactions.id';

    public string $sortField = 'transactions.date';

    public string $sortDirection = 'desc';

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('Transactions')
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function header(): array
    {
        return [
            Button::add('bulk-delete')
                ->caption(__('Delete Selected'))
                ->class('cursor-pointer block bg-red-500 text-white px-2 py-1 rounded-lg shadow-lg')
                ->emit('bulkDelete', []),
        ];
    }

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\transaction>
     */
    public function datasource(): Builder
    {
        return Transaction::query()->whereBelongsTo($this->account)
            ->join('tags', 'tags.id', '=', 'tag_id', 'left outer')
            ->join('types', 'types.id', '=', 'type_id', 'left outer')
            ->join('categories', 'categories.id', '=', 'category_id', 'left outer')
            ->select('transactions.*', 'categories.category as category', 'tags.tag as tag', 'types.type as type');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('amount', function (Transaction $transaction) {
                $fmt = new NumberFormatter('nl_BE', NumberFormatter::CURRENCY);

                return $fmt->formatCurrency($transaction->amount, 'EUR');
            })
            ->addColumn('recipient')
            ->addColumn('message')
            ->addColumn('date_formatted', fn (transaction $model) => Carbon::parse($model->date)->format('d/m/Y H:i'))
            ->addColumn('type')
            ->addColumn('tag')
            ->addColumn('category');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),

            Column::make('DATE', 'date_formatted', 'date')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('AMOUNT', 'amount')
                ->sortable()
                ->makeInputRange(),

            Column::make('RECIPIENT', 'recipient')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('MESSAGE', 'message')
                ->searchable()
                ->makeInputText(),

            Column::make('TYPE', 'type')
                ->searchable()
                ->sortable()
                ->makeInputSelect(Type::all(), 'type'),

            Column::make('TAG', 'tag')
                ->searchable()
                ->sortable()
                ->makeInputSelect(auth()->user()->tags, 'tag'),

            Column::make('CATEGORY', 'category')
                ->searchable()
                ->sortable()
                ->makeInputSelect(Category::all(), 'category'),
        ];
    }

    // listen to more than defaults
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'transactionsChanged' => '$refresh',
                'bulkDelete' => 'bulkDelete',
            ]
        );
    }

    public function bulkDelete()
    {
        $ids = $this->checkboxValues;
        if (empty($ids)) {
            $this->notification()->info('Nothing selected', 'You did not select any records');
        } else {
            $this->dialog()->confirm([
                'title' => 'Delete multiple transactions?',
                'description' => 'Are you sure you want to delete the following transactions: ' . implode(', ', $ids),
                'accept' => [
                    'label' => 'Yes, delete them all',
                    'method' => 'bulkDeleteConfirmed',
                ],
                'reject' => [
                    'label' => 'No, cancel',
                    'method' => 'cancelDelete',
                ],
            ]);
        }
    }

    public function bulkDeleteConfirmed()
    {
        $ids = $this->checkboxValues;
        foreach ($ids as $id) {
            Transaction::find($id)->delete();
        }
        $this->notification()->success('Successfully deleted', 'All transactions where Deleted');
        $this->checkboxValues = [];
    }

    public function cancelDelete()
    {
        $this->notification()->warning(
            $title = 'Action canceled',
            $description = 'the transactions were not deleted'
        );
    }

    /**
     * PowerGrid transaction Action Buttons.
     *
     * @return array<int, Button>
     */
    public function actions(): array
    {
        return [
            Button::make('destroy', 'Delete')
                ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                ->emit('deleteTransaction', ['id' => 'id']),
        ];
    }

    /**
     * PowerGrid transaction Action Rules.
     *
     * @return array<int, RuleActions>
     */
    public function actionRules(): array
    {
        return [
            //Hide button delete for users not owning the account
            Rule::button('destroy')
                ->when(function () {
                    return $this->account->user->id !== auth()->user()->id;
                })
                ->hide(),
        ];
    }
}
