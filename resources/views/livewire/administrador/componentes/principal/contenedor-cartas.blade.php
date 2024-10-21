{{-- Because she competes with no one, no one can compete with her. --}}
<div class="w-full rounded-md bg-white px-4 pb-4 dark:bg-gray-800 ">
    <div class="flex justify-between border-b border-gray-200 py-2">
        <h1 class="font-semibold">Registros</h1>
        <div class="" wire:click="refresh">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                class="cursor-pointer fill-black dark:fill-white " wire.target="refresh"
                wire:loading.class="animate-spin">
                <path
                    d="M480-160q-134 0-227-93t-93-227q0-134 93-227t227-93q69 0 132 28.5T720-690v-110h80v280H520v-80h168q-32-56-87.5-88T480-720q-100 0-170 70t-70 170q0 100 70 170t170 70q77 0 139-44t87-116h84q-28 106-114 173t-196 67Z" />
            </svg>
        </div>
    </div>

    <div class="mt-2 grid grid-cols-16 gap-2">

        {{-- new users --}}
        <div class="bg-gray-100 rounded-md px-2 py-2 dark:bg-gray-700">
            <div class="flex justify-end font-semibold text-xs text-gray-600 dark:text-white"> <span>USUARIOS
                    REGISTRADOS</span>
            </div>
            <div class="font-bold flex justify-end pt-5 text-xl">
                <span>{{ $usuarios }}</span>
            </div>

            <div class="pt-2 flex justify-between">
                <div class="w-12 h-12 bg-purple-200 rounded-md flex items-center justify-center cursor-help"
                    data-tippy-content="Usuarios registrados en el sistema."><svg xmlns="http://www.w3.org/2000/svg"
                        height="24px" viewBox="0 -960 960 960" width="24px" fill="#56145b">
                        <path
                            d="M720-400v-120H600v-80h120v-120h80v120h120v80H800v120h-80Zm-360-80q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm80-80h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm0 400Z" />
                    </svg></div>
                <a href="{{ route('admin.registros.usuarios') }}" class="mt-auto text-blue-600">Ver detalles</a>
            </div>
        </div>


        {{-- new clients --}}
        <div class="bg-gray-100 rounded-md px-2 py-2 dark:bg-gray-700">
            <div class="flex justify-end font-semibold text-xs text-gray-600 dark:text-white"> <span>CLIENTES
                    REGISTRADOS</span>
            </div>
            <div class="font-bold flex justify-end pt-5 text-xl">
                <span>{{ $clientes }}</span>
            </div>

            <div class="pt-2 flex justify-between">
                <div class="w-12 h-12 bg-blue-200 rounded-md flex items-center justify-center cursor-help"
                    data-tippy-content="Clientes registrados en el sistema."><svg xmlns="http://www.w3.org/2000/svg"
                        height="24px" viewBox="0 -960 960 960" width="24px" fill="#0000F5">
                        <path
                            d="M720-400v-120H600v-80h120v-120h80v120h120v80H800v120h-80Zm-360-80q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm80-80h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm0 400Z" />
                    </svg></div>
                <a href="{{ route('admin.registros.clientes') }}" class="mt-auto text-blue-600">Ver detalles</a>
            </div>
        </div>

        {{-- Clients without a manager --}}
        <div class="bg-gray-100 rounded-md px-2 py-2 dark:bg-gray-700">
            <div class="flex justify-end font-semibold text-xs text-gray-600 dark:text-white"> <span>CLIENTES SIN
                    GESTOR</span>
            </div>
            <div class="font-bold flex justify-end pt-5 text-xl">
                <span>{{ $clientes_gestor }}</span>
            </div>

            <div class="pt-2 flex justify-between">
                <div class="w-12 h-12 bg-green-200 rounded-md flex items-center justify-center cursor-help"
                    data-tippy-content="Clientes registrados en el sistema que aún no tienen gestor."><svg
                        xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#228B22">
                        <path
                            d="M680-360q-42 0-71-29t-29-71q0-42 29-71t71-29q42 0 71 29t29 71q0 42-29 71t-71 29ZM480-160v-56q0-24 12.5-44.5T528-290q36-15 74.5-22.5T680-320q39 0 77.5 7.5T832-290q23 9 35.5 29.5T880-216v56H480Zm-80-320q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm0-160ZM80-160v-112q0-34 17-62.5t47-43.5q60-30 124.5-46T400-440q35 0 70 6t70 14l-34 34-34 34q-18-5-36-6.5t-36-1.5q-58 0-113.5 14T180-306q-10 5-15 14t-5 20v32h240v80H80Zm320-80Zm0-320q33 0 56.5-23.5T480-640q0-33-23.5-56.5T400-720q-33 0-56.5 23.5T320-640q0 33 23.5 56.5T400-560Z" />
                    </svg></div>
                <a href="" class="mt-auto text-blue-600">Ver detalles</a>
            </div>
        </div>

        {{-- manager --}}
        <div class="bg-gray-100 rounded-md px-2 py-2 dark:bg-gray-700">
            <div class="flex justify-end font-semibold text-xs text-gray-600 dark:text-white"> <span>GESTORES
                    NUEVOS</span>
            </div>
            <div class="font-bold flex justify-end pt-5 text-xl">
                <span>{{ $gestores }}</span>
            </div>

            <div class="pt-2 flex justify-between">
                <div class="w-12 h-12 bg-red-200 rounded-md flex items-center justify-center cursor-help"
                    data-tippy-content="Gestores registrados en el sistema."><svg xmlns="http://www.w3.org/2000/svg"
                        height="24px" viewBox="0 -960 960 960" width="24px" fill="#FF0000">
                        <path
                            d="M720-400v-120H600v-80h120v-120h80v120h120v80H800v120h-80Zm-360-80q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm80-80h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm0 400Z" />
                    </svg></div>
                <a href="{{ route('admin.registros.gestores') }}" class="mt-auto text-blue-600">Ver detalles</a>
            </div>
        </div>

        {{-- employees --}}
        <div class="bg-gray-100 rounded-md px-2 py-2 dark:bg-gray-700">
            <div class="flex justify-end font-semibold text-xs text-gray-600 dark:text-white"> <span>EMPLEADOS
                    NUEVOS</span>
            </div>
            <div class="font-bold flex justify-end pt-5 text-xl">
                <span>{{ $empleados }}</span>
            </div>

            <div class="pt-2 flex justify-between">
                <div class="w-12 h-12 bg-yellow-200 rounded-md flex items-center justify-center cursor-help"
                    data-tippy-content="Empleados registrados en el sistema."><svg xmlns="http://www.w3.org/2000/svg"
                        height="24px" viewBox="0 -960 960 960" width="24px" fill="#808000">
                        <path
                            d="M160-80q-33 0-56.5-23.5T80-160v-440q0-33 23.5-56.5T160-680h200v-120q0-33 23.5-56.5T440-880h80q33 0 56.5 23.5T600-800v120h200q33 0 56.5 23.5T880-600v440q0 33-23.5 56.5T800-80H160Zm0-80h640v-440H600q0 33-23.5 56.5T520-520h-80q-33 0-56.5-23.5T360-600H160v440Zm80-80h240v-18q0-17-9.5-31.5T444-312q-20-9-40.5-13.5T360-330q-23 0-43.5 4.5T276-312q-17 8-26.5 22.5T240-258v18Zm320-60h160v-60H560v60Zm-200-60q25 0 42.5-17.5T420-420q0-25-17.5-42.5T360-480q-25 0-42.5 17.5T300-420q0 25 17.5 42.5T360-360Zm200-60h160v-60H560v60ZM440-600h80v-200h-80v200Zm40 220Z" />
                    </svg></div>
                <a href="{{ route('admin.registros.empleados') }}" class="mt-auto text-blue-600">Ver detalles</a>
            </div>
        </div>


    </div>
</div>
