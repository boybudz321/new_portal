<x-filament-panels::page>
    <div x-data="dashboard()" x-init="initialize" wire:ignore class="relative ">
        <div class="grid-stack"></div>
    </div>

    <!-- Edit Widget Modal -->
    <div x-data="{
        show: @entangle('showEditModal'),
        init() {
            this.$watch('show', value => {
                if (!value) {
                    $wire.resetForm()
                }
            })
        }
    }" x-show="show" @click.away="show = false" class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none;">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal panel -->
            <div x-show="show" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div class="w-full">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Edit Widget
                        </h3>

                        <form wire:submit.prevent="updateWidget" class="mt-4 space-y-4">
                            <div>
                                <label for="formTitle"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                                <input type="text" wire:model="formTitle" id="formTitle"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 focus:ring-primary-500">
                                @error('formTitle')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="formUrl"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">URL</label>
                                <input type="url" wire:model="formUrl" id="formUrl"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 focus:ring-primary-500">
                                @error('formUrl')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="formIcon"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Icon</label>
                                <input type="text" wire:model="formIcon" id="formIcon"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 focus:ring-primary-500">
                                @error('formIcon')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="formBackgroundColor"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Background
                                        Color</label>
                                    <div class="flex mt-1">
                                        <input type="color" wire:model="formBackgroundColor" id="formBackgroundColor"
                                            class="w-full h-10 border-gray-300 rounded-md shadow-sm dark:border-gray-700 focus:border-primary-500 focus:ring-primary-500">
                                    </div>
                                    @error('formBackgroundColor')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="formBorderColor"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Border
                                        Color</label>
                                    <div class="flex mt-1">
                                        <input type="color" wire:model="formBorderColor" id="formBorderColor"
                                            class="w-full h-10 border-gray-300 rounded-md shadow-sm dark:border-gray-700 focus:border-primary-500 focus:ring-primary-500">
                                    </div>
                                    @error('formBorderColor')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="formImagePath"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                                <div class="flex items-center mt-1">
                                    @if ($formImagePath)
                                        <div class="relative">
                                            <img src="{{ Storage::url($formImagePath) }}" alt="Widget image"
                                                class="object-cover w-16 h-16 rounded-md">
                                            <button type="button" wire:click="removeImage"
                                                class="absolute p-1 text-white bg-red-500 rounded-full -top-2 -right-2 hover:bg-red-600 focus:outline-none">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @endif
                                    <input type="file" wire:model="formImagePath" id="formImagePath"
                                        class="block w-full mt-1 text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-gray-800 dark:file:text-gray-300"
                                        accept="image/*">
                                </div>
                                @error('formImagePath')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model="formHasCredentials" class="sr-only peer">
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">Has
                                        Credentials</span>
                                </label>
                            </div>

                            @if ($formHasCredentials)
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label for="formUsername"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                                        <input type="text" wire:model="formUsername" id="formUsername"
                                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 focus:ring-primary-500">
                                        @error('formUsername')
                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="formPassword"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">New
                                            Password</label>
                                        <input type="password" wire:model="formPassword" id="formPassword"
                                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 focus:ring-primary-500">
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Leave blank to keep
                                            current password</p>
                                        @error('formPassword')
                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-center justify-end mt-6 gap-x-3">
                                <button type="button" wire:click="resetForm"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white rounded-lg shadow-sm bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:hover:bg-primary-800">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gridstack.js/7.2.3/gridstack-all.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/gridstack.js/7.2.3/gridstack.min.css" rel="stylesheet" />

        <script>
            function dashboard() {
                return {
                    grid: null,

                    initialize() {
                        this.grid = GridStack.init({
                            cellHeight: 'auto',
                            column: 12,
                            draggable: {
                                handle: '.grid-stack-item-content'
                            },
                            resizable: {
                                handles: 'e,se,s,sw,w'
                            },
                            disableOneColumnMode: true,
                        });

                        this.loadWidgets();

                        this.grid.on('change', (event, items) => {
                            items.forEach(item => {
                                @this.call('updateWidgetPosition', item.id, item.x, item.y, item.w, item.h);
                            });
                        });

                        Livewire.on('widget-created', (event) => {
                            this.addWidget(event.widgetId);
                        });

                        Livewire.on('widget-updated', (event) => {
                            // Remove the old widget
                            const widget = this.grid.engine.nodes.find(n => n.id === event.widgetId);
                            if (widget) {
                                const x = widget.x;
                                const y = widget.y;
                                const w = widget.w;
                                const h = widget.h;
                                this.grid.removeWidget(widget.el);
                                // Add the updated widget back in the same position
                                this.addWidget(event.widgetId, x, y, w, h);
                            }
                        });
                    },

                    handleResize() {
                        // Update the grid when the window is resized
                        this.grid.update();
                    },

                    loadWidgets() {
                        const widgets = @json($this->getViewData()['widgets']);
                        widgets.forEach(widget => this.addWidget(widget.id, widget.position_x, widget.position_y, widget.width,
                            widget.height));
                    },

                    getTextColor(bgColor) {
                        // Convert hex to RGB
                        const r = parseInt(bgColor.slice(1, 3), 16);
                        const g = parseInt(bgColor.slice(3, 5), 16);
                        const b = parseInt(bgColor.slice(5, 7), 16);

                        // Calculate relative luminance
                        const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;

                        // Return black for light backgrounds, white for dark backgrounds
                        return luminance > 0.5 ? 'text-black' : 'text-white';
                    },

                    copyToClipboard(text) {
                        navigator.clipboard.writeText(text).then(() => {
                            // Show a brief "Copied!" message
                            const messageElement = document.createElement('div');
                            messageElement.textContent = 'Copied!';
                            messageElement.style.position = 'fixed';
                            messageElement.style.bottom = '20px';
                            messageElement.style.left = '50%';
                            messageElement.style.transform = 'translateX(-50%)';
                            messageElement.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
                            messageElement.style.color = 'white';
                            messageElement.style.padding = '10px 20px';
                            messageElement.style.borderRadius = '5px';
                            messageElement.style.zIndex = '9999';
                            document.body.appendChild(messageElement);

                            setTimeout(() => {
                                document.body.removeChild(messageElement);
                            }, 2000);
                        }).catch(err => {
                            console.error('Failed to copy text: ', err);
                        });
                    },

                    addWidget(widgetId, x = 0, y = 0, w = 4, h = 2) {
                        const widget = @json($this->getViewData()['widgets']).find(w => w.id == widgetId);
                        if (!widget) return;

                        const imageUrl = widget.image_path ? `/storage/${widget.image_path}` : null;

                        const imageContent = imageUrl ?
                            `<a href="${widget.url}" target="_blank" class="mt-2 cursor-pointer" style="height: auto;">
                                <img src="${imageUrl}"
                                    alt="${widget.title}"
                                    class="rounded-lg"
                                    style="height: auto; width: 100%;">
                            </a>` : '';

                        const bgColor = widget.background_color || null;
                        const borderColor = widget.border_color || null;
                        const textColorClass = bgColor ? this.getTextColor(bgColor) : '';

                        const widgetContent = `
                            <div x-data="{ open: false, portalRoot: null, showPassword: false }"
                                x-init="portalRoot = document.querySelector('body')"
                                class="p-2 transition-shadow rounded sm:p-4 widget-content hover:shadow-lg
                                        ${bgColor ? '' : 'bg-white dark:bg-gray-900'}
                                        ${borderColor ? '' : 'border-gray-200 dark:border-gray-800'}
                                        ${textColorClass || 'text-black dark:text-white'}"
                                style="${bgColor ? `background-color: ${bgColor};` : ''}
                                        ${borderColor ? `border-color: ${borderColor};` : ''}">
                                <div class="flex flex-row items-start justify-between mb-0 sm:mb-2 sm:flex-row sm:items-center">
                                    <div class="flex flex-row items-center justify-center gap-1 mb-2 sm:gap-2 sm:mb-0">
                                        <a href="${widget.url}" target="_blank" class="items-start justify-start hidden sm:flex sm:text-4xl">
                                            ${widget.icon}
                                        </a>
                                        <div class="flex flex-col items-start justify-center">
                                            <div class="flex flex-row items-start justify-center gap-1">
                                                <a href="${widget.url}" target="_blank" class="flex sm:hidden text-[8px] pt-[1px]">
                                                    ${widget.icon}
                                                </a>
                                                <a href="${widget.url}" target="_blank" class="text-[10px] font-semibold truncate transition duration-300 sm:text-lg">${widget.title}</a>
                                            </div>
                                            <a href="${widget.url}" target="_blank" class="flex-grow block text-[10px] sm:text-sm truncate sm:text-sm hover:underline">
                                                ${widget.url.replace(/^https?:\/\//, '')}
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Actions menu -->
                                    <div class="relative">
                                        <button @click="open = !open" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                            </svg>
                                        </button>

                                        <div x-show="open"
                                             @click.away="open = false"
                                             class="absolute right-0 z-50 w-48 mt-2 bg-white border border-gray-200 rounded-md shadow-lg dark:bg-gray-800 dark:border-gray-700">
                                            <div class="py-1">
                                                <button @click="$wire.editWidget(${widget.id}); open = false"
                                                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                                    <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Edit
                                                </button>
                                                <button @click="$wire.removeWidget(${widget.id}); open = false"
                                                    class="block w-full px-4 py-2 text-sm text-left text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-700">
                                                    <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ${widget.has_credentials ? `
                                                                                            <div class="mt-0 sm:mt-2 text-[8px] sm:text-xs z-100 ml-0 sm:ml-4">
                                                                                                <p class="text-[5px] sm:text-xs truncate">
                                                                                                    <span class="text-[5px] sm:text-xs font-semibold">
                                                                                                        Username:
                                                                                                    </span>
                                                                                                    ${widget.username}
                                                                                                </p>
                                                                                                <div class="flex items-center">
                                                                                                    <div class="flex flex-row items-start justify-start sm:flex-row">
                                                                                                        <div class="flex flex-row">
                                                                                                            <span class="mr-1 sm:mr-2 text-[5px] sm:text-xs font-semibold">Password:</span>
                                                                                                            <span
                                                                                                                x-text="showPassword ? '${widget.password}' : '${'•'.repeat(5)}'"
                                                                                                                @click="$parent.copyToClipboard('${widget.password}')"
                                                                                                                class="cursor-pointer text-[5px] sm:text-xs"
                                                                                                                title="Click to copy"
                                                                                                            ></span>
                                                                                                        </div>
                                                                                                        <button @click="showPassword = !showPassword" class="ml-1 sm:ml-2 focus:outline-none">
                                                                                                            <svg x-show="!showPassword" class="w-2 h-2 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                                                            </svg>
                                                                                                            <svg x-show="showPassword" class="w-2 h-2 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                                                                                            </svg>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        ` : ''}
                                <div class="flex-col flex-1 hidden sm:flex">
                                    ${imageContent}
                                </div>
                            </div>
                        `;

                        this.grid.addWidget({
                            id: widgetId,
                            content: widgetContent,
                            x: x,
                            y: y,
                            w: w,
                            h: h
                        });
                    }
                }
            }
        </script>

        <style>
            .grid-stack {
                /* padding: 10px; */
            }

            .grid-stack-item-content {
                inset: 5px !important;
                height: auto !important;
                transition: box-shadow 0.3s ease;
                border-radius: 1rem;
                background-color: transparent;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 5px;
            }

            .ui-resizable-handle {
                z-index: 1 !important;
            }

            .widget-content {
                height: 100%;
                width: 100%;
                overflow-y: hidden;
                /* -webkit-box-shadow: 0px 4px 6px -5px rgba(0, 0, 0, 0.3);
                                                                                                                                                                        -moz-box-shadow: 0px 4px 6px -5px rgba(0, 0, 0, 0.3); */
                border-radius: 1rem;
                border: 0.1rem solid rgba(231, 231, 231, 0.9);

            }

            .widget-content::-webkit-scrollbar {
                width: 2px;
            }

            .widget-content::-webkit-scrollbar-track {
                background: transparent;
            }

            .widget-content::-webkit-scrollbar-thumb {
                background-color: rgba(155, 155, 155, 0.5);
                border-radius: 3px;
                border: transparent
            }

            .widget-content {
                scrollbar-width: thin;
                scrollbar-color: rgba(155, 155, 155, 0.5) transparent;
            }

            .dark .widget-content::-webkit-scrollbar-thumb {
                background-color: rgba(200, 200, 200, 0.5);
            }

            .dark .widget-content {
                border: 1px solid rgba(44, 44, 44, 0.9);
                scrollbar-color: rgba(200, 200, 200, 0.5) transparent;
            }

            .widget-content img {
                transition: transform 0.3s ease;
            }

            .widget-content img:hover {
                transform: scale(1.05);
            }
        </style>
    @endpush
</x-filament-panels::page>
