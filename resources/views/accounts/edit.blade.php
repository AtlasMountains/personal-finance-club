<x-layout.app>

    <h1 class="text-3xl font-bold text-center dark:text-white">create a new account</h1>

    <x-forms.form action="{{ route('user.account.update', $account) }}">
        @method('PUT')
        <x-forms.input for="name" :value="$account->name">
            account name
        </x-forms.input>

        <x-forms.input for="alert" type="number" step=".01" :value="$account->alert">
            alert
        </x-forms.input>

        <div>
            <label for="type" class="w-full mx-2 text-body-color dark:text-gray-200">type</label>
            <select name="type" id="type" class="text-center bg-white rounded shadow p-1">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->type }}
                    </option>
                @endforeach
            </select>
        </div>

        <x-forms.button type="submit">Update</x-forms.button>

    </x-forms.form>
</x-layout.app>
