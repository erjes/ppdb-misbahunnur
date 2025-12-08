<div
  class="min-h-screen bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50 flex flex-col items-center justify-center p-4 md:p-8"
  id="form-start">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <div class="w-full max-w-5xl">
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
      <div class="bg-gradient-to-r from-green-700 via-green-600 to-emerald-600 p-8 md:p-10">
        <div class="flex justify-center mb-6">
          <div class="bg-white p-3 rounded-2xl shadow-lg">
            <a href="/">
              <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }} logo"
                class="h-16 w-auto rounded-xl">
            </a>
          </div>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-white mb-3 text-center tracking-tight">
          {{ __('Formulir Pendaftaran Siswa Baru') }}
        </h1>

        <div class="flex items-center justify-center gap-3 mb-6">
          <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
            <p class="text-sm font-medium text-white">
              Langkah {{ $currentStep }} dari {{ $maxSteps + 1 }}
            </p>
          </div>
          <div class="h-1 w-20 bg-white/30 rounded-full overflow-hidden">
            <div class="h-full bg-white rounded-full transition-all duration-500"
              style="width: {{ ($currentStep / ($maxSteps + 1)) * 100 }}%"></div>
          </div>
        </div>

        <p class="text-base text-green-50 text-center font-medium">
          {{ $currentStepData['title'] ?? 'Selesai' }}
        </p>
      </div>

      <div class="p-6 md:p-10">
        @if (session()->has('error'))
          <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg mb-6 shadow-sm">
            <div class="flex items-center">
              <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
              <span>{{ session('error') }}</span>
            </div>
          </div>
        @endif

        <form wire:submit.prevent="submitForm" enctype="multipart/form-data">
          @csrf

          @if ($currentStep === 1)
            <div class="mb-8">
              <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <span
                  class="bg-gradient-to-r from-green-600 to-emerald-600 text-white w-10 h-10 rounded-xl flex items-center justify-center mr-3 shadow-md">
                  <i class="fa-regular fa-clipboard text-lg"></i>
                </span>
                {{ $currentStepData['title'] }}
              </h2>

              @if (isset($currentStepData['fields']) && count($currentStepData['fields']) > 0)
                <div class="space-y-6">
                  @foreach ($currentStepData['fields'] as $field)
                    @if ($field['name'] === 'jenjang_daftar')
                      @php
                        $fieldId = 'field-' . $field['name'];
                        $fieldLabel = $field['label'] . ($field['required'] ?? false ? ' *' : '');
                      @endphp
                      <div class="bg-gradient-to-br from-gray-50 to-green-50/30 p-2 rounded-xl shadow-sm">
                        <label for="{{ $fieldId }}"
                          class="block text-gray-700 font-semibold text-base mb-3 flex items-center">
                          <i class="fas fa-graduation-cap text-green-600 mr-2"></i>
                          {{ $fieldLabel }}
                        </label>
                        <select id="{{ $fieldId }}" wire:model.live="formData.{{ $field['name'] }}"
                          class="block w-full bg-white border-2 border-green-600 focus:border-green-500 focus:ring-4 focus:ring-green-100 rounded-xl shadow-sm text-gray-700 py-3 px-4 transition-all">
                          <option value="">{{ $field['placeholder'] ?? 'Pilih Jenis Pendaftaran' }}</option>
                          @foreach ($field['options'] ?? [] as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                          @endforeach
                        </select>
                        @error('formData.' . $field['name'])
                          <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-info-circle mr-1"></i>{{ $message }}
                          </p>
                        @enderror
                      </div>
                    @endif

                    @if ($field['name'] === 'jalur_daftar')
                      @php
                        $fieldId = 'field-' . $field['name'];
                        $fieldLabel = $field['label'] . ($field['required'] ?? false ? ' *' : '');
                      @endphp
                      <div class="bg-gradient-to-br from-gray-50 to-green-50/30 p-2 rounded-xl shadow-sm">
                        <label for="{{ $fieldId }}"
                          class="block text-gray-700 font-semibold text-base mb-3 flex items-center">
                          <i class="fas fa-route text-green-600 mr-2"></i>
                          {{ $fieldLabel }}
                        </label>
                        <select id="{{ $fieldId }}" wire:model.live="formData.{{ $field['name'] }}"
                          class="block w-full bg-white border-2 border-green-600 focus:border-green-500 focus:ring-4 focus:ring-green-100 rounded-xl shadow-sm text-gray-700 py-3 px-4 transition-all">
                          <option value="">{{ $field['placeholder'] ?? 'Pilih Jalur Pendaftaran' }}</option>
                          @foreach ($field['options'] ?? [] as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                          @endforeach
                        </select>
                        @error('formData.' . $field['name'])
                          <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-info-circle mr-1"></i>{{ $message }}
                          </p>
                        @enderror
                      </div>
                    @endif
                  @endforeach
                </div>
              @endif

              <div class="space-y-3 my-8">
                <div
                  class="bg-gradient-to-r from-blue-50 to-indigo-50 p-5 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-shadow">
                  <div class="flex items-center">
                    <span
                      class="bg-blue-500 text-white w-8 h-8 rounded-lg flex items-center justify-center mr-3 flex-shrink-0 font-bold text-sm shadow">1</span>
                    <p class="text-gray-700 text-sm leading-relaxed">Setiap calon peserta didik wajib mengisi form
                      pendaftaran...</p>
                  </div>
                </div>
                <div
                  class="bg-gradient-to-r from-purple-50 to-pink-50 p-5 rounded-xl border-l-4 border-purple-500 shadow-sm hover:shadow-md transition-shadow">
                  <div class="flex items-center">
                    <span
                      class="bg-purple-500 text-white w-8 h-8 rounded-lg flex items-center justify-center mr-3 flex-shrink-0 font-bold text-sm shadow">2</span>
                    <p class="text-gray-700 text-sm leading-relaxed">Calon peserta didik yang sudah mendaftar secara
                      online akan mendapatkan Nomor Pendaftaran...</p>
                  </div>
                </div>
                <div
                  class="bg-gradient-to-r from-amber-50 to-orange-50 p-5 rounded-xl border-l-4 border-amber-500 shadow-sm hover:shadow-md transition-shadow">
                  <div class="flex items-center">
                    <span
                      class="bg-amber-500 text-white w-8 h-8 rounded-lg flex items-center justify-center mr-3 flex-shrink-0 font-bold text-sm shadow">3</span>
                    <p class="text-gray-700 text-sm leading-relaxed">...</p>
                  </div>
                </div>
              </div>

              <div
                class="mt-8 p-6 bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl shadow-sm">
                @foreach ($currentStepData['fields'] ?? [] as $field)
                  @if ($field['name'] === 'setuju_ketentuan')
                    <label for="setuju_ketentuan" class="flex items-center space-x-3 cursor-pointer group">
                      <input type="checkbox" id="setuju_ketentuan" wire:model.live="setuju_ketentuan"
                        class="rounded-lg text-green-600 focus:ring-green-500 focus:ring-offset-2 w-5 h-5 border-2 border-gray-300 cursor-pointer transition-all">
                      <span
                        class="text-gray-700 font-medium leading-relaxed group-hover:text-green-700 transition-colors">
                        Dengan mengklik tombol, Saya setuju dengan syarat & ketentuan...
                      </span>
                    </label>
                  @endif
                @endforeach
              </div>
            </div>
          @elseif ($currentStep > 1 && $currentStep <= $maxSteps)
            <div class="mb-8">
              <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <span
                  class="bg-gradient-to-r from-green-600 to-emerald-600 text-white w-10 h-10 rounded-xl flex items-center justify-center mr-3 shadow-md">
                  <i class="fas fa-user-edit text-lg"></i>
                </span>
                {{ $currentStepData['title'] }}
              </h2>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($currentStepData['fields'] as $field)
                  @php
                    $fieldName = $field['name'];
                    $fieldId = 'field-' . $fieldName;
                    $fieldLabel = $field['label'] . ($field['required'] ?? false ? ' *' : '');

                    $iconMap = [
                        'text' => 'fa-keyboard',
                        'number' => 'fa-hashtag',
                        'email' => 'fa-envelope',
                        'date' => 'fa-calendar',
                        'textarea' => 'fa-align-left',
                        'select' => 'fa-list',
                    ];
                    $iconClass = $iconMap[$field['type']] ?? 'fa-pen';
                  @endphp

                  <div class="bg-gradient-to-br from-gray-50 to-green-50/30 p-2 rounded-xl shadow-sm">
                    <label for="{{ $fieldId }}"
                      class="block text-gray-700 font-semibold text-base mb-3 flex items-center">
                      <i class="fas {{ $iconClass }} text-green-600 mr-2"></i>
                      {{ $fieldLabel }}
                    </label>

                    @switch($field['type'])
                      @case('text')
                      @case('number')

                      @case('email')
                      @case('date')
                        <input id="{{ $fieldId }}" type="{{ $field['type'] }}"
                          wire:model.defer="formData.{{ $fieldName }}"
                          class="block w-full bg-white border-2 border-green-600 focus:border-green-500 focus:ring-4 focus:ring-green-100 rounded-xl shadow-sm text-gray-700 py-3 px-4 transition-all"
                          placeholder="{{ $field['placeholder'] ?? '' }}"
                          @if ($fieldName === 'nomor_pendaftaran') readonly @endif>
                      @break

                      @case('textarea')
                        <textarea id="{{ $fieldId }}" wire:model.defer="formData.{{ $fieldName }}" rows="3"
                          class="block w-full bg-white border-2 border-green-600 focus:border-green-500 focus:ring-4 focus:ring-green-100 rounded-xl shadow-sm text-gray-700 py-3 px-4 transition-all"
                          placeholder="{{ $field['placeholder'] ?? '' }}"></textarea>
                      @break

                      @case('select')
                        <select id="{{ $fieldId }}" wire:model.defer="formData.{{ $fieldName }}"
                          class="block w-full bg-white border-2 border-green-600 focus:border-green-500 focus:ring-4 focus:ring-green-100 rounded-xl shadow-sm text-gray-700 py-3 px-4 transition-all">
                          <option value="">{{ $field['placeholder'] ?? 'Pilih salah satu' }}</option>
                          @foreach ($field['options'] ?? [] as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                          @endforeach
                        </select>
                      @break
                    @endswitch

                    @error('formData.' . $fieldName)
                      <p class="text-red-500 text-sm mt-2 flex items-center">
                        <i class="fas fa-info-circle mr-1"></i>{{ $message }}
                      </p>
                    @enderror
                  </div>
                @endforeach
              </div>
            </div>
          @elseif ($currentStep == $maxSteps + 1)
            <div class="mb-8">
              <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <span
                  class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white w-10 h-10 rounded-xl flex items-center justify-center mr-3 shadow-md">
                  <i class="fas fa-clipboard-check text-lg"></i>
                </span>
                KONFIRMASI DATA CALON SISWA
              </h2>

              <div
                class="p-6 bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-xl shadow-sm">
                <label for="konfirmasi_data_sesuai" class="flex items-start space-x-3 cursor-pointer group">
                  <input type="checkbox" id="konfirmasi_data_sesuai" wire:model.live="konfirmasi_data_sesuai"
                    class="mt-1 rounded-lg text-blue-600 focus:ring-blue-500 focus:ring-offset-2 w-5 h-5 border-2 border-gray-300 cursor-pointer transition-all">
                  <span class="text-gray-700 font-medium leading-relaxed group-hover:text-blue-700 transition-colors">
                    <i class="fas fa-check-double text-blue-600 mr-1"></i>
                    Apakah data calon siswa sudah sesuai? Ya, data sudah sesuai!
                  </span>
                </label>
                @error('konfirmasi_data_sesuai')
                  <p class="text-red-500 text-sm mt-3 flex items-center">
                    <i class="fas fa-info-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
            </div>
          @else
            <div class="text-center py-12">
              @if (session()->has('message'))
                <div
                  class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-5 rounded-xl mb-8 mx-auto max-w-2xl shadow-lg">
                  <div class="flex items-center justify-center mb-2">
                    <i class="fas fa-check-circle text-3xl text-green-500"></i>
                  </div>
                  {!! session('message') !!}
                </div>
              @endif

              <div class="mb-6">
                <div
                  class="w-24 h-24 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl">
                  <i class="fas fa-check text-5xl text-white"></i>
                </div>
                <h2
                  class="text-4xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent mb-4">
                  Pendaftaran Berhasil!
                </h2>
                <p class="mt-4 mb-8 text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">{!! session('message') !!}
                </p>
              </div>

              <a href="/"
                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl font-semibold hover:from-green-700 hover:to-emerald-700 shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                <i class="fas fa-home mr-2"></i>
                Kembali ke Beranda
              </a>
            </div>
          @endif

          @if ($currentStep <= $maxSteps + 1)
            <div class="flex justify-between items-center mt-10 pt-6">
              @if ($currentStep > 1)
                <button type="button" wire:click="previousStep"
                  class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl hover:bg-gray-200 transition-all font-medium shadow-sm hover:shadow-md">
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
                  class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl transition-all font-medium shadow-lg {{ !$canProceed ? 'opacity-50 cursor-not-allowed' : 'hover:from-green-700 hover:to-emerald-700 hover:shadow-xl transform hover:-translate-y-0.5' }}"
                  @if (!$canProceed) disabled @endif>
                  {{ __('Selanjutnya') }} <i class="fas fa-arrow-right ml-2"></i>
                @else
                  <button type="submit"
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 {{ !$konfirmasi_data_sesuai ? 'opacity-50 cursor-not-allowed' : '' }}"
                    @if (!$konfirmasi_data_sesuai) disabled @endif>
                    <i class="fas fa-paper-plane mr-2"></i> {{ __('Kirim Pendaftaran') }}
                  </button>
              @endif
            </div>
          @endif
        </form>
      </div>
    </div>

    <div class="text-center mt-6">
      <p class="text-sm text-gray-600">
        {{ __('Kembali ke') }}
        <a href="{{ url('/') }}"
          class="underline font-semibold text-green-600 hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 rounded-md transition-colors">
          {{ __('Halaman Utama') }}
        </a>
      </p>
    </div>
  </div>
</div>
