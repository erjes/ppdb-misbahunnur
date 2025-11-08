<div class="min-h-screen bg-gray-100 flex flex-col items-center justify-center p-8 md:p-12" id="form-start">
    <div class="w-full max-w-4xl bg-green-800 p-8 rounded-lg shadow-md">
        <div class="flex justify-center mb-6">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }} logo"
                    class="h-16 w-auto rounded-full">
            </a>
        </div>

        <h1 class="text-3xl font-bold text-white mb-2 text-center md:text-left">
            {{ __('Formulir Pendaftaran Siswa Baru') }}
        </h1>
        <p class="text-sm text-green-200 mb-8 text-center md:text-left">
            Langkah {{ $currentStep }} dari {{ $maxSteps + 1 }} - {{ $currentStepData['title'] ?? 'Selesai' }}
        </p>

        @if (session()->has('error'))
            <div class="bg-red-200 border border-red-500 text-red-800 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="submitForm" enctype="multipart/form-data">
            @csrf

            @if ($currentStep === 1)
                <h2 class="text-xl font-semibold text-white border-b border-green-600 pb-2 mb-4 text-center md:text-left">
                    {{ $currentStepData['title'] }}
                </h2>

                @if (isset($currentStepData['fields']) && count($currentStepData['fields']) > 0)
                    @foreach ($currentStepData['fields'] as $field)
                        @if ($field['name'] === 'jenjang_daftar')
                            @php
                                $fieldId = "field-".$field['name'];
                                $fieldLabel = $field['label'] . (($field['required'] ?? false) ? ' *' : '');
                            @endphp
                            <div class="mb-6">
                                <label for="{{ $fieldId }}" class="block text-green-100 font-medium text-base mb-3">{{ $fieldLabel }}</label>
                                <select id="{{ $fieldId }}" wire:model.live="formData.{{ $field['name'] }}"
                                    class="block w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700 py-2 px-3">
                                    <option value="">{{ $field['placeholder'] ?? 'Pilih Jenis Pendaftaran' }}</option>
                                    @foreach ($field['options'] ?? [] as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('formData.' . $field['name'])
                                    <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        @if ($field['name'] === 'jalur_daftar')
                        @php
                            $fieldId = "field-".$field['name'];
                            $fieldLabel = $field['label'] . (($field['required'] ?? false) ? ' *' : '');
                        @endphp
                        <div class="mb-6">
                            <label for="{{ $fieldId }}" class="block text-green-100 font-medium text-base mb-3">{{ $fieldLabel }}</label>
                            <select id="{{ $fieldId }}" wire:model.live="formData.{{ $field['name'] }}"
                                class="block w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700 py-2 px-3">
                                <option value="">{{ $field['placeholder'] ?? 'Pilih Jenis Pendaftaran' }}</option>
                                @foreach ($field['options'] ?? [] as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('formData.' . $field['name'])
                                <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                    @endforeach
                @endif

                <div class="space-y-4 text-sm text-green-100 mb-6">
                    <div class="p-3 bg-green-900 rounded shadow-sm">1. Setiap calon peserta didik wajib mengisi form pendaftaran...</div>
                    <div class="p-3 bg-green-900 rounded shadow-sm">2. Calon peserta didik yang sudah mendaftar secara online akan mendapatkan Nomor Pendaftaran...</div>
                    <div class="p-3 bg-green-900 rounded shadow-sm">...</div>
                </div>

                <div class="mt-6 p-4 bg-green-700 border border-green-600 rounded">
                    @foreach ($currentStepData['fields'] ?? [] as $field)
                        @if ($field['name'] === 'setuju_ketentuan')
                            <label for="setuju_ketentuan" class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" id="setuju_ketentuan" wire:model.live="setuju_ketentuan"
                                    class="rounded text-green-500 focus:ring-green-500">
                                <span class="text-green-100 font-semibold">
                                    Dengan mengklik tombol, Saya setuju dengan syarat & ketentuan...
                                </span>
                            </label>
                        @endif
                    @endforeach
                </div>

            @elseif ($currentStep > 1 && $currentStep <= $maxSteps)
                <h2 class="text-xl font-semibold text-white border-b border-green-600 pb-2 mb-4">
                    {{ $currentStepData['title'] }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($currentStepData['fields'] as $field)
                        @php
                            $fieldName = $field['name'];
                            $fieldId = "field-".$fieldName;
                            $fieldLabel = $field['label'] . (($field['required'] ?? false) ? ' *' : '');
                        @endphp

                        <div>
                            <label for="{{ $fieldId }}" class="block text-green-100 font-medium text-sm mb-1">{{ $fieldLabel }}</label>

                            @switch($field['type'])
                                @case('text')
                                @case('number')
                                @case('email')
                                @case('date')
                                    <input id="{{ $fieldId }}" type="{{ $field['type'] }}"
                                        wire:model.defer="formData.{{ $fieldName }}"
                                        class="block w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700"
                                        placeholder="{{ $field['placeholder'] ?? '' }}"
                                        @if ($fieldName === 'nomor_pendaftaran') readonly @endif>
                                    @break
                                
                                @case('textarea')
                                    <textarea id="{{ $fieldId }}" wire:model.defer="formData.{{ $fieldName }}" rows="3"
                                        class="block w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700"
                                        placeholder="{{ $field['placeholder'] ?? '' }}"></textarea>
                                    @break

                                @case('select')
                                    <select id="{{ $fieldId }}" wire:model.defer="formData.{{ $fieldName }}"
                                        class="block w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700">
                                        <option value="">{{ $field['placeholder'] ?? 'Pilih salah satu' }}</option>
                                        @foreach ($field['options'] ?? [] as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @break
                            @endswitch

                            @error('formData.' . $fieldName)
                                <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>

            @elseif ($currentStep == $maxSteps + 1)
                <h2 class="text-xl font-semibold text-white border-b border-green-600 pb-2 mb-4">
                    KONFIRMASI DATA CALON SISWA
                </h2>

                <div class="p-4 bg-green-700 border border-green-600 rounded">
                    <label for="konfirmasi_data_sesuai" class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" id="konfirmasi_data_sesuai" wire:model.live="konfirmasi_data_sesuai"
                            class="rounded text-green-500 focus:ring-green-500">
                        <span class="text-green-100 font-semibold">
                            Apakah data calon siswa sudah sesuai? Ya, data sudah sesuai!
                        </span>
                    </label>
                    @error('konfirmasi_data_sesuai') <p class="text-red-300 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

            @else
                <div class="text-center p-10 text-green-100">
                    @if (session()->has('message'))
                        <div class="bg-green-200 border border-green-500 text-green-800 px-4 py-3 rounded mb-8 mx-auto max-w-lg">
                            {!! session('message') !!}
                        </div>
                    @endif
                    
                    <h2 class="text-3xl font-bold text-white mb-4">Pendaftaran Berhasil!</h2>
                    <p class="mt-4 mb-8 text-lg">{!! session('message') !!}</p>

                    <a href="/" class="mt-6 inline-block px-6 py-3 bg-green-600 text-white rounded-md font-semibold hover:bg-green-700">
                        Kembali ke Beranda
                    </a>
                </div>
            @endif

            @if ($currentStep <= $maxSteps + 1)
                <div class="flex justify-between mt-8 pt-4 border-t border-green-700">
                    @if ($currentStep > 1)
                        <button type="button" wire:click="previousStep"
                            class="px-4 py-2 bg-green-700 text-green-100 rounded-md hover:bg-green-600 transition">
                            <i class="fas fa-arrow-left mr-2"></i> {{ __('Kembali') }}
                        </button>
                    @else
                        <div></div>
                    @endif

                    @if ($currentStep < $maxSteps + 1)
                        @php
                            $canProceed = $currentStep == 1 ? $this->canProceedFromStep1 : true;
                        @endphp
                        <button type="button" wire:click="nextStep"
                            class="px-4 py-2 bg-green-500 text-white rounded-md transition {{ !$canProceed ? 'opacity-50 cursor-not-allowed' : 'hover:bg-green-400' }}"
                            @if(!$canProceed) disabled @endif>
                            {{ __('Selanjutnya') }} <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    @else
                        <button type="submit"
                            class="px-6 py-3 bg-green-600 text-white rounded-md font-semibold hover:bg-green-700 transition"
                            @if (!$konfirmasi_data_sesuai) disabled @endif>
                            <i class="fas fa-check-circle mr-2"></i> {{ __('Kirim Pendaftaran') }}
                        </button>
                    @endif
                </div>
            @endif
        </form>

        <div class="text-center mt-4">
            <p class="text-sm text-green-200">
                {{ __('Kembali ke') }}
                <a href="{{ url('/') }}"
                    class="underline font-semibold text-white hover:text-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-800 focus:ring-green-500 rounded-md">
                    {{ __('Halaman Utama') }}
                </a>
            </p>
        </div>
    </div>
</div>
