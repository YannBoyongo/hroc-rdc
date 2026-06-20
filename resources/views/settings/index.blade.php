<x-app-layout>
    <x-slot name="header">
        {{ __('Settings') }}
    </x-slot>

    <div class="space-y-6">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-blue_green-50 border border-blue_green-200 text-blue_green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Settings Form -->
        <form method="POST" action="{{ route('settings.update') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            @csrf
            @method('PATCH')

            <div class="p-6 space-y-6">
                <!-- Contact Information Section -->
                <div>
                    <h3 class="text-lg font-semibold text-deep_twilight-500 mb-4">{{ __('Contact Information') }}</h3>
                    
                    <div class="space-y-4">
                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" 
                                         class="block mt-1 w-full" 
                                         type="email" 
                                         name="email" 
                                         :value="old('email', $settings->email)" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Phone Numbers -->
                        <div>
                            <x-input-label for="phone" :value="__('Phone Numbers')" />
                            <div id="phone-container" class="space-y-2 mt-1">
                                @if(old('phone') || $settings->phone)
                                    @foreach(old('phone', $settings->phone ?? []) as $index => $phone)
                                        <div class="flex gap-2 phone-input-group">
                                            <x-text-input type="text" 
                                                         name="phone[]" 
                                                         class="flex-1" 
                                                         :value="$phone" 
                                                         placeholder="+243 000 000 000" />
                                            <button type="button" 
                                                    class="px-3 py-2 text-sm text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors remove-phone"
                                                    @if($loop->first) style="display: none;" @endif>
                                                {{ __('Remove') }}
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="flex gap-2 phone-input-group">
                                        <x-text-input type="text" 
                                                     name="phone[]" 
                                                     class="flex-1" 
                                                     value="" 
                                                     placeholder="+243 000 000 000" />
                                        <button type="button" 
                                                class="px-3 py-2 text-sm text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors remove-phone"
                                                style="display: none;">
                                            {{ __('Remove') }}
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" 
                                    id="add-phone" 
                                    class="mt-2 text-sm text-blue_green-600 hover:text-blue_green-800 font-medium">
                                + {{ __('Add Phone Number') }}
                            </button>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            <x-input-error :messages="$errors->get('phone.*')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <textarea id="address" 
                                      name="address" 
                                      rows="3" 
                                      class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm">{{ old('address', $settings->address) }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" 
                                      name="description" 
                                      rows="5" 
                                      class="block mt-1 w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm">{{ old('description', $settings->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Social Media Section -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-deep_twilight-500 mb-4">{{ __('Social Media Links') }}</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Facebook -->
                        <div>
                            <x-input-label for="facebook" :value="__('Facebook')" />
                            <x-text-input id="facebook" 
                                         class="block mt-1 w-full" 
                                         type="url" 
                                         name="facebook" 
                                         :value="old('facebook', $settings->facebook)" 
                                         placeholder="https://facebook.com/..." />
                            <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
                        </div>

                        <!-- X (Twitter) -->
                        <div>
                            <x-input-label for="x" :value="__('X (Twitter)')" />
                            <x-text-input id="x" 
                                         class="block mt-1 w-full" 
                                         type="url" 
                                         name="x" 
                                         :value="old('x', $settings->x)" 
                                         placeholder="https://x.com/..." />
                            <x-input-error :messages="$errors->get('x')" class="mt-2" />
                        </div>

                        <!-- LinkedIn -->
                        <div>
                            <x-input-label for="linkedin" :value="__('LinkedIn')" />
                            <x-text-input id="linkedin" 
                                         class="block mt-1 w-full" 
                                         type="url" 
                                         name="linkedin" 
                                         :value="old('linkedin', $settings->linkedin)" 
                                         placeholder="https://linkedin.com/company/..." />
                            <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
                        </div>

                        <!-- YouTube -->
                        <div>
                            <x-input-label for="youtube" :value="__('YouTube')" />
                            <x-text-input id="youtube" 
                                         class="block mt-1 w-full" 
                                         type="url" 
                                         name="youtube" 
                                         :value="old('youtube', $settings->youtube)" 
                                         placeholder="https://youtube.com/..." />
                            <x-input-error :messages="$errors->get('youtube')" class="mt-2" />
                        </div>

                        <!-- TikTok -->
                        <div>
                            <x-input-label for="tiktok" :value="__('TikTok')" />
                            <x-text-input id="tiktok" 
                                         class="block mt-1 w-full" 
                                         type="url" 
                                         name="tiktok" 
                                         :value="old('tiktok', $settings->tiktok)" 
                                         placeholder="https://tiktok.com/@..." />
                            <x-input-error :messages="$errors->get('tiktok')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Bank Details Section -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-deep_twilight-500 mb-4">{{ __('Bank Details') }}</h3>
                    
                    <div class="space-y-4">
                        <!-- Bank Name -->
                        <div>
                            <x-input-label for="bank_name" :value="__('Bank Name')" />
                            <div class="flex gap-2 mt-1">
                                <x-text-input id="bank_name" 
                                             class="flex-1" 
                                             type="text" 
                                             name="bank_name" 
                                             :value="old('bank_name', $settings->bank_name)" 
                                             placeholder="Banque Commerciale du Congo" />
                                <button type="button" 
                                        class="copy-btn px-4 py-2 text-sm font-medium text-deep_twilight-500 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors"
                                        data-copy-target="bank_name">
                                    {{ __('Copy') }}
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('bank_name')" class="mt-2" />
                        </div>

                        <!-- Account Number -->
                        <div>
                            <x-input-label for="account_number" :value="__('Account Number')" />
                            <div class="flex gap-2 mt-1">
                                <x-text-input id="account_number" 
                                             class="flex-1" 
                                             type="text" 
                                             name="account_number" 
                                             :value="old('account_number', $settings->account_number)" 
                                             placeholder="1234567890123456" />
                                <button type="button" 
                                        class="copy-btn px-4 py-2 text-sm font-medium text-deep_twilight-500 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors"
                                        data-copy-target="account_number">
                                    {{ __('Copy') }}
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('account_number')" class="mt-2" />
                        </div>

                        <!-- SWIFT / BIC Code -->
                        <div>
                            <x-input-label for="swift_bic_code" :value="__('SWIFT / BIC Code')" />
                            <div class="flex gap-2 mt-1">
                                <x-text-input id="swift_bic_code" 
                                             class="flex-1" 
                                             type="text" 
                                             name="swift_bic_code" 
                                             :value="old('swift_bic_code', $settings->swift_bic_code)" 
                                             placeholder="BCOCCDCGXXX" />
                                <button type="button" 
                                        class="copy-btn px-4 py-2 text-sm font-medium text-deep_twilight-500 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors"
                                        data-copy-target="swift_bic_code">
                                    {{ __('Copy') }}
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('swift_bic_code')" class="mt-2" />
                        </div>

                        <!-- Beneficiary -->
                        <div>
                            <x-input-label for="beneficiary" :value="__('Beneficiary')" />
                            <div class="flex gap-2 mt-1">
                                <x-text-input id="beneficiary" 
                                             class="flex-1" 
                                             type="text" 
                                             name="beneficiary" 
                                             :value="old('beneficiary', $settings->beneficiary)" 
                                             placeholder="HROC RDC" />
                                <button type="button" 
                                        class="copy-btn px-4 py-2 text-sm font-medium text-deep_twilight-500 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors"
                                        data-copy-target="beneficiary">
                                    {{ __('Copy') }}
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('beneficiary')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <x-primary-button>
                    {{ __('Save Settings') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneContainer = document.getElementById('phone-container');
            const addPhoneBtn = document.getElementById('add-phone');

            // Add phone number field
            addPhoneBtn.addEventListener('click', function() {
                const phoneGroup = document.createElement('div');
                phoneGroup.className = 'flex gap-2 phone-input-group';
                phoneGroup.innerHTML = `
                    <input type="text" 
                           name="phone[]" 
                           class="block w-full border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm" 
                           placeholder="+243 000 000 000" />
                    <button type="button" 
                            class="px-3 py-2 text-sm text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors remove-phone">
                        {{ __('Remove') }}
                    </button>
                `;
                phoneContainer.appendChild(phoneGroup);
                updateRemoveButtons();
            });

            // Remove phone number field
            phoneContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-phone')) {
                    const phoneGroups = phoneContainer.querySelectorAll('.phone-input-group');
                    if (phoneGroups.length > 1) {
                        e.target.closest('.phone-input-group').remove();
                        updateRemoveButtons();
                    }
                }
            });

            // Show/hide remove buttons based on number of phone fields
            function updateRemoveButtons() {
                const phoneGroups = phoneContainer.querySelectorAll('.phone-input-group');
                const removeButtons = phoneContainer.querySelectorAll('.remove-phone');
                
                removeButtons.forEach((btn, index) => {
                    btn.style.display = phoneGroups.length > 1 ? 'block' : 'none';
                });
            }

            // Initialize on load
            updateRemoveButtons();

            // Copy to clipboard functionality
            document.querySelectorAll('.copy-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-copy-target');
                    const input = document.getElementById(targetId);
                    
                    if (input && input.value) {
                        input.select();
                        input.setSelectionRange(0, 99999); // For mobile devices
                        
                        navigator.clipboard.writeText(input.value).then(function() {
                            // Visual feedback
                            const originalText = btn.textContent;
                            btn.textContent = '{{ __('Copied!') }}';
                            btn.classList.add('bg-blue_green-100', 'text-blue_green-700');
                            btn.classList.remove('bg-gray-100', 'text-deep_twilight-500');
                            
                            setTimeout(function() {
                                btn.textContent = originalText;
                                btn.classList.remove('bg-blue_green-100', 'text-blue_green-700');
                                btn.classList.add('bg-gray-100', 'text-deep_twilight-500');
                            }, 2000);
                        }).catch(function(err) {
                            console.error('Failed to copy: ', err);
                        });
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
