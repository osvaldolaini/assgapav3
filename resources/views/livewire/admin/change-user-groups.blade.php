<div>
    <select wire:model="user_groups_id" wire:change="changeGroup"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
        focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700
        dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500
        dark:focus:border-primary-500"
    >
        <option value="">Selecione uma opção</option>
        @foreach ($groups as $item)
            <option value="{{ $item->id }}">{{ $item->title }}</option>
        @endforeach
    </select>
</div>
