<x-layout.app>


    <h1 class="text-3xl font-bold dark:text-white">create a new account</h1>
    <x-forms.form action="{{ route('user.account.store') }}">

        <x-forms.input for="name" :value="old('name')">
            account name
        </x-forms.input>

        <x-forms.input for="balance" type="number" step=".01" :value="old('balance')">
            starting balance
        </x-forms.input>

        <x-forms.input for="alert" type="number" step=".01" :value="old('alert')">
            alert
        </x-forms.input>

        <div>
            <label for="type" class="w-full mx-2 text-body-color dark:text-gray-200">type</label>
            <select name="type" id="type" class="p-3 bg-white rounded shadow">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->type }}
                    </option>
                @endforeach
            </select>
        </div>

        <x-forms.button type="submit">submit</x-forms.button>

    </x-forms.form>
</x-layout.app>
