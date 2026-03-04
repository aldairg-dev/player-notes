<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Notas de Jugadores</h2>
        </div>
        @can('add player notes')
        <button wire:click="openAddPlayerModal(false)"
            class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                    clip-rule="evenodd" />
            </svg>
            Agregar Jugador
        </button>
        @endcan
    </div>

    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50">
                    <th scope="col"
                        class="py-3.5 pl-6 pr-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Jugador</th>
                    <th scope="col"
                        class="px-4 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Usuario</th>
                    <th scope="col"
                        class="px-4 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Correo
                    </th>
                    <th scope="col"
                        class="px-4 py-3.5 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Notas</th>
                    <th scope="col"
                        class="px-4 py-3.5 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 pr-6">
                        Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($players as $player)
                <tr class="hover:bg-gray-50/60 transition-colors duration-100">
                    <td class="py-4 pl-6 pr-3 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <span
                                class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 text-indigo-700 text-sm font-bold">
                                {{ strtoupper(substr($player->full_name, 0, 1)) }}
                            </span>
                            <span class="text-sm font-medium text-gray-900">{{ $player->full_name }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $player->username }}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $player->email }}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-center">
                        <span
                            class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $player->notes->count() > 0 ? 'bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20' : 'bg-gray-50 text-gray-600 ring-1 ring-inset ring-gray-500/10' }}">
                            {{ $player->notes->count() }}
                        </span>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-right pr-6">
                        <div class="flex items-center justify-end gap-2">
                            {{-- @can('update info player')
                            <button wire:click="openAddPlayerModal(true, {{ $player}})"
                                class="inline-flex items-center gap-1.5 rounded-md bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors duration-100"
                                title="Ver Notas">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Editar Jugador
                            </button>
                            @endcan --}}
                            @can('view player notes')
                            <button wire:click="openNotes({{ $player->id }})"
                                class="inline-flex items-center gap-1.5 rounded-md bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors duration-100"
                                title="Ver Notas">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Ver
                            </button>
                            @endcan
                            @can('add player notes')
                            <button wire:click="openAddNote({{ $player->id }})"
                                class="inline-flex items-center gap-1.5 rounded-md bg-indigo-50 px-3 py-1.5 text-xs font-medium text-indigo-700 shadow-sm ring-1 ring-inset ring-indigo-700/10 hover:bg-indigo-100 transition-colors duration-100"
                                title="Agregar Comentario">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                Agregar Comentario
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="mt-2 text-sm font-medium text-gray-500">No se encontraron jugadores.</p>
                        <p class="text-xs text-gray-400">Comienza agregando un nuevo jugador.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    @can('view player notes')
    @if ($showModal && $selectedPlayerId)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 text-center sm:p-0">
            <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" wire:click="closeNotes"></div>

            <div
                class="relative inline-block w-full max-w-2xl my-8 text-left align-middle bg-white rounded-2xl shadow-2xl transform transition-all">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900" id="modal-title">Historial de Notas</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Todos los comentarios de este jugador</p>
                    </div>
                    <button wire:click="closeNotes"
                        class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="px-6 py-4 overflow-y-auto max-h-[28rem] space-y-3">
                    @forelse ($history as $note)
                    <div class="rounded-lg border border-gray-100 bg-gray-50/50 p-4">
                        <p class="text-sm text-gray-800 leading-relaxed">{{ $note->content }}</p>
                        <div class="mt-3 flex items-center gap-3 text-xs text-gray-500">
                            <span class="inline-flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $note->author->name }}
                            </span>
                            <span class="text-gray-300">|</span>
                            <span class="inline-flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $note->created_at->format('M d, Y') }}
                            </span>
                            <span class="text-gray-300">|</span>
                            <span class="inline-flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.828a1 1 0 101.415-1.414L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $note->created_at->format('h:i A') }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                        <p class="mt-2 text-sm font-medium text-gray-500">Aún no hay notas</p>
                        <p class="text-xs text-gray-400">Las notas de este jugador aparecerán aquí.</p>
                    </div>
                    @endforelse
                </div>

                <div class="flex justify-end px-6 py-4 border-t border-gray-100 bg-gray-50/50 rounded-b-2xl">
                    <button wire:click="closeNotes" type="button"
                        class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 bg-white ring-1 ring-inset ring-gray-300 shadow-sm hover:bg-gray-50 transition-colors">
                        Cerrar
                    </button>
                    @can('add player notes')
                    <button wire:click="openAddNote({{ $selectedPlayerId }})"
                        class="inline-flex items-center gap-1.5 rounded-md bg-indigo-50 px-3 py-1.5 text-xs font-medium text-indigo-700 shadow-sm ring-1 ring-inset ring-indigo-700/10 hover:bg-indigo-100 transition-colors duration-100"
                        title="Agregar Comentario">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        Agregar Comentario
                    </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @endif
    @endcan


    @can('add player notes')
    @if ($showAddNoteModal && $selectedPlayerId)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="add-note-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 text-center sm:p-0">
            <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" wire:click="closeAddNote">
            </div>

            <div
                class="relative inline-block w-full max-w-lg my-8 text-left align-middle bg-white rounded-2xl shadow-2xl transform transition-all">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900" id="add-note-title">Agregar Comentario</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Escribe una nueva nota para este jugador</p>
                    </div>
                    <button wire:click="closeAddNote"
                        class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="confirmSaveNote">
                    <div class="px-6 py-5">
                        <label for="noteContent"
                            class="block text-sm font-medium text-gray-700 mb-1.5">Comentario</label>
                        <textarea wire:model.defer="noteContent" id="noteContent" rows="4" maxlength="1002"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm placeholder-gray-400 resize-none"
                            placeholder="Escribe tu comentario aquí..."></textarea>
                        @error('noteContent')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1.5 text-xs text-gray-400 text-right">Máximo 1000 caracteres</p>
                    </div>

                    <div class="flex justify-end gap-3 px-6 py-3 border-t border-gray-100 bg-gray-50/50 rounded-b-2xl">
                        <button wire:click="closeAddNote" type="button"
                            class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 bg-white ring-1 ring-inset ring-gray-300 shadow-sm hover:bg-gray-50 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors">
                            Guardar Comentario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    @endcan


    @can('add player notes')
    @if ($showAddPlayerModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="add-player-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 text-center sm:p-0">
            <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
                wire:click="closeAddPlayerModal"></div>

            <div
                class="relative inline-block w-full max-w-lg my-8 text-left align-middle bg-white rounded-2xl shadow-2xl transform transition-all">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900" id="add-player-title">@if($isEditMode) Editar
                            Jugador @else Agregar Jugador @endif</h3>
                        {{-- <p class="text-xs text-gray-500 mt-0.5">Registra un nuevo jugador en el sistema</p> --}}
                    </div>
                    <button wire:click="closeAddPlayerModal"
                        class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="confirmSavePlayer">
                    <div class="px-6 py-5 space-y-4">
                        <div>
                            <label for="playerFullName" class="block text-sm font-medium text-gray-700 mb-1">Nombre
                                Completo</label>
                            <input type="text" wire:model.defer="playerFullName" id="playerFullName"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Juan Pérez">
                            @error('playerFullName')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="playerUsername"
                                class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
                            <input type="text" wire:model.defer="playerUsername" id="playerUsername"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="juanperez">
                            @error('playerUsername')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="playerEmail" class="block text-sm font-medium text-gray-700 mb-1">Correo
                                Electrónico</label>
                            <input type="email" wire:model.defer="playerEmail" id="playerEmail"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="juan@ejemplo.com">
                            @error('playerEmail')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="playerTypeId" class="block text-sm font-medium text-gray-700 mb-1">Tipo
                                    de ID</label>
                                <select wire:model.defer="playerTypeId" id="playerTypeId"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">Seleccionar...</option>
                                    <option value="CC">Cédula Ciudadana</option>
                                    <option value="DNI">DNI</option>
                                    <option value="Passport">Pasaporte</option>
                                    <option value="License">Licencia</option>
                                </select>
                                @error('playerTypeId')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="playerIdNumber" class="block text-sm font-medium text-gray-700 mb-1">Número
                                    de Identificación</label>
                                <input type="text" wire:model.defer="playerIdNumber" id="playerIdNumber"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="12345678">
                                @error('playerIdNumber')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 px-6 py-3 border-t border-gray-100 bg-gray-50/50 rounded-b-2xl">
                        <button wire:click="closeAddPlayerModal" type="button"
                            class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 bg-white ring-1 ring-inset ring-gray-300 shadow-sm hover:bg-gray-50 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors">
                            @if($isEditMode) Actualizar Jugador @else Agregar Jugador @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    @endcan

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('swal:success', (data) => {
                Swal.fire({
                    icon: 'success',
                    title: data[0].title ?? '¡Éxito!',
                    text: data[0].text ?? 'Operación completada correctamente.',
                    timer: 2500,
                    showConfirmButton: false,
                    toast: false,
                    position: 'center',
                    customClass: {
                        popup: 'rounded-xl'
                    }
                });
            });

            Livewire.on('swal:error', (data) => {
                Swal.fire({
                    icon: 'error',
                    title: data[0].title ?? '¡Error!',
                    text: data[0].text ?? 'Algo salió mal.',
                    confirmButtonColor: '#4f46e5',
                    customClass: {
                        popup: 'rounded-xl'
                    }
                });
            });

            Livewire.on('swal:confirm-save-note', (data) => {
                Swal.fire({
                    icon: 'question',
                    title: '¿Guardar comentario?',
                    text: '¿Estás seguro de que deseas guardar este comentario?',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#4f46e5',
                    cancelButtonColor: '#6b7280',
                    customClass: {
                        popup: 'rounded-xl'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('confirmedSaveNote');
                    }
                });
            });

            Livewire.on('swal:confirm-save-player', (data) => {
                Swal.fire({
                    icon: 'question',
                    title: '¿Guardar jugador?',
                    text: '¿Estás seguro de que deseas registrar este jugador?',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#4f46e5',
                    cancelButtonColor: '#6b7280',
                    customClass: {
                        popup: 'rounded-xl'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('confirmedSavePlayer');
                    }
                });
            });
        });
    </script>
</div>
