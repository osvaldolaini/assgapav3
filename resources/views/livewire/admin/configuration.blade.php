<div>
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    CONFIGURAÇÕES
                </h3>
            </div>
        </div>
    </x-breadcrumb>
    <section class="p-6 dark:bg-gray-800 dark:text-gray-50">
        <form wire:submit.prevent="update()" wire.loading.attr='disable'
            class="container flex flex-col mx-auto space-y-12">
            <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md dark:bg-gray-900">
                <div class="space-y-2 col-span-full lg:col-span-1">
                    <p class="font-medium">Informações do site</p>
                    <p class="text-xs">Informe aqui todos os dados possíveis para melhorar o acesso do seu cliente.</p>
                    @livewire('admin.logo-upload-file')
                </div>
                <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-full">
                        <label for="title">*Nome completo</label>
                        <input
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="Nome completo" wire:model="title" required maxlength="100"
                            value="{{ old('title', $title ?? '') }}">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="acronym">Nome curto</label>
                        <input
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="Nome curto" wire:model="acronym" value="{{ old('acronym', $acronym ?? '') }}">
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="cpf_cnpj">CNPJ</label>
                        <input x-mask="99.999.999/9999-99" placeholder="00.000.000/0000-00"
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            wire:model="cpf_cnpj" value="{{ old('cpf_cnpj', $cpf_cnpj ?? '') }}">
                    </div>
                    <div class="col-span-full">
                        <label for="email">E-mail</label>
                        <input type="email"
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="E-mail" wire:model="email" value="{{ old('email', $email ?? '') }}">
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="phone">Telefone fixo</label>
                        <input x-mask="(99) 9999-9999" type="text"
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="Telefone fixo" wire:model="phone" value="{{ old('phone', $phone ?? '') }}">
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="cellphone">Telefone móvel</label>
                        <input type="text" x-mask="(99) 9 9999-9999"
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="Telefone móvel" wire:model="cellphone"
                            value="{{ old('cellphone', $cellphone ?? '') }}">
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="whatsapp">Whatsapp</label>
                        <input type="text" x-mask="(99) 9 9999-9999"
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="Whatsapp" wire:model="whatsapp" value="{{ old('whatsapp', $whatsapp ?? '') }}">
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="telegram">Telegram</label>
                        <input type="text" x-mask="(99) 9 9999-9999"
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="Telegram" wire:model="telegram" value="{{ old('telegram', $telegram ?? '') }}">
                    </div>
                    <div class="col-span-full">
                        <label for="meta_description">Descrição (150 caracteres)</label>
                        <textarea class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" maxlength="150"
                            wire:model="meta_description" rows="5">{{ old('meta_description', $meta_description ?? '') }}</textarea>
                    </div>
                    <div class="col-span-full">
                        <label for="meta_tags">Palavras chave (80 caracteres)</label>
                        <textarea class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" maxlength="80"
                            wire:model="meta_tags" rows="5">{{ old('meta_tags', $meta_tags ?? 'As palavras chaves devem ser separadas por ","') }}</textarea>
                    </div>
                    {{-- <div class="col-span-full">
                        <label for="video_link">Link do vídeo de divulgação</label>
                        <input class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="Link do vídeo" wire:model="video_link" value="{{ old('video_link', $video_link ?? '') }}">
                    </div> --}}

                    <div class="col-span-full sm:col-span-2">
                        <label for="postalCode">CEP</label>
                        <input x-mask="99999-999"
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            maxlength="10" placeholder="CEP" wire:model.lazy="postalCode"
                            value="{{ old('postalCode', $postalCode ?? '') }}">
                    </div>

                    <div class="col-span-full sm:col-span-4">
                        <label for="address">Rua</label>
                        <input
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="Rua, Av, Travessa, etc" wire:model="address"
                            value="{{ old('address', $address ?? '') }}">
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="number">Número</label>
                        <input
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="nº" wire:model="number" value="{{ old('number', $number ?? '') }}">
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="about">Bairro</label>
                        <input
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="Bairro" wire:model="district"
                            value="{{ old('district', $district ?? '') }}">
                    </div>
                    <div class="col-span-full sm:col-span-5">
                        <label for="city">Cidade</label>
                        <input
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="Cidade" wire:model="city" value="{{ old('city', $city ?? '') }}">
                    </div>

                    <div class="col-span-full sm:col-span-1">
                        <label for="state">Estado</label>
                        <input
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="UF" x-mask="aa" name="state" maxlength="2" wire:model="state"
                            value="{{ old('state', $state ?? '') }}">
                    </div>
                    <div class="col-span-full">
                        <label for="complement">Complemento</label>
                        <input
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="Complemento" name="complement"
                            value="{{ old('complement', $complement ?? '') }}">
                    </div>
                    {{-- <div class="col-span-full" wire:ignore>
                        <textarea wire:model.defer="about" id="about">
                            {{ old('about', $about ?? '') }}
                        </textarea>
                    </div> --}}
                    <div class="flex col-span-full items-center space-x-4 mt-10 justify-end">
                        <button class="btn btn-neutral">Salvar</button>
                    </div>
                </div>
        </form>
        </fieldset>
    </section>
</div>

