<div>
    <h2>Upload Bukti Pembayaran</h2>
    <form wire:submit.prevent="submitPaymentProof" enctype="multipart/form-data">
        <div class="form-group">
            <label for="paymentProof">Bukti Pembayaran</label>
            <input type="file" id="paymentProof" wire:model="paymentProof" class="form-control">
            
            @error('paymentProof')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>
        </div>
    </form>

    @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif
</div>
