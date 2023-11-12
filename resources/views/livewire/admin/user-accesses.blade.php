<div>
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki sm:text-3xl dark:text-gray-50">
                    {{ $this->breadcrumb_title }}
                </h3>
            </div>
        </div>
    </x-breadcrumb>
    <div>
        <section class="p-6 dark:bg-gray-800 dark:text-gray-50">
            <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md dark:bg-gray-900">
                <div class="space-y-2 col-span-full lg:col-span-1">
                    <p class="font-medium">Acessos do usuário</p>
                    <p class="text-xs">Informe aqui quais as abas o usuário irá acessar.</p>
                </div>
                <div class="grid grid-cols-12 gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-2 sm:col-span-6">
                        <x-link-checkbox :access="$access" page="1" title="Configurações"></x-link-checkbox>
                    </div>
                    <div class="col-span-2 sm:col-span-6">
                        <x-link-checkbox :access="$access" page="2" title="Lista de usuários"></x-link-checkbox>
                    </div>
                    <div class="col-span-2 sm:col-span-6">
                        <x-link-checkbox :access="$access" page="3" title="Cadastros"></x-link-checkbox>
                    </div>
                    <div class="col-span-2 sm:col-span-6">
                        <x-link-checkbox :access="$access" page="4" title="Ambientes"></x-link-checkbox>
                    </div>
                </div>
            </fieldset>
        </section>
    </div>
</div>
