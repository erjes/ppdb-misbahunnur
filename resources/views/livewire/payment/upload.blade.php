<div class="max-w-4xl mx-auto space-y-6">

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm animate-fade-in-down"
            role="alert">
            <div class="flex items-center">
                <i class="fa-solid fa-check-circle text-2xl mr-3"></i>
                <div>
                    <p class="font-bold">Berhasil!</p>
                    <p class="text-sm">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">

        <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center">
                <i class="fa-solid fa-money-bill-wave mr-3"></i>
                Upload Bukti Pembayaran
            </h2>
        </div>

        <div class="p-6 md:p-8">

            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-8">
                <div class="flex items-start">
                    <i class="fa-solid fa-info-circle text-blue-600 text-xl mr-3 mt-1"></i>
                    <div>
                        <p class="font-semibold text-blue-800 mb-1">Instruksi Pembayaran</p>
                        <p class="text-blue-700 text-sm">
                            Silakan upload foto/screenshot bukti transfer yang jelas. Pastikan nominal dan tanggal
                            transfer terlihat.
                            Format yang diterima: <span class="font-bold">JPG, PNG, PDF</span>. Maksimal <span
                                class="font-bold">2MB</span>.
                        </p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="submitPaymentProof" enctype="multipart/form-data" class="space-y-6">

                <div
                    class="border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-green-500 transition-colors duration-300 bg-gray-50 text-center group">

                    @if ($paymentProof && !is_string($paymentProof) && in_array($paymentProof->extension(), ['jpg', 'jpeg', 'png']))
                        <div class="mb-4 relative w-full max-w-sm mx-auto">
                            <img src="{{ $paymentProof->temporaryUrl() }}" alt="Preview Bukti"
                                class="rounded-lg shadow-md border border-gray-200 w-full object-cover">
                            <p class="text-xs text-center text-gray-500 mt-2">Preview File Terpilih</p>
                        </div>
                    @else
                        <div class="mb-4">
                            <div
                                class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300">
                                <i class="fa-solid fa-cloud-upload-alt text-2xl"></i>
                            </div>
                            <label for="paymentProof"
                                class="block text-gray-700 font-semibold cursor-pointer group-hover:text-green-600">
                                Klik untuk memilih file bukti pembayaran
                            </label>
                            <p class="text-xs text-gray-400 mt-1">atau drag & drop file di sini</p>
                        </div>
                    @endif

                    <input type="file" id="paymentProof" wire:model="paymentProof"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-600 file:text-white hover:file:bg-green-700 cursor-pointer mx-auto max-w-md">

                    <div wire:loading wire:target="paymentProof" class="text-sm text-green-600 mt-2 font-medium">
                        <i class="fa-solid fa-spinner fa-spin mr-1"></i> Mengupload preview...
                    </div>

                    @error('paymentProof')
                        <div
                            class="mt-3 bg-red-50 text-red-600 px-4 py-2 rounded-md text-sm inline-block border border-red-200">
                            <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <button type="submit" wire:loading.attr="disabled"
                        class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-lg font-semibold text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">

                        <span wire:loading.remove wire:target="submitPaymentProof">
                            <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Bukti Pembayaran
                        </span>

                        <span wire:loading wire:target="submitPaymentProof" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Mengirim Data...
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>