<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Transaction;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\Rules\RuleActions;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use WireUi\Traits\Actions;

final class TransactionsTable extends PowerGridComponent
{
    use Actions;
    use ActionButton;

    public $account;

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
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
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
            ->addColumn('amount')
            ->addColumn('recipient')
            ->addColumn('message', function (Transaction $model) {
                return Str::limit($model->message, 10); //Gets the first x words
            })
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
                ->makeInputSelect(Tag::all(), 'tag'),

            Column::make('CATEGORY', 'category')
                ->searchable()
                ->sortable()
                ->makeInputSelect(Category::all(), 'category'),
        ];
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

    // listen to more than defaults
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'transactionDeleted' => '$refresh',
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid transaction Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [
           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($transaction) => $transaction->id === 1)
                ->hide(),
        ];
    }
    */
}
