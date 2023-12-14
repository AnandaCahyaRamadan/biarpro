@extends('main')
  @section('content')
    <section class="mt-5">
      <div class="container mt-4">
          <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span>Keranjang</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Nama Paket</h6>
                  <small class="text-muted">{{ $nama_paket }}</small>
                </div>
                <img src="{{ asset('storage/'. $image) }}" class="img-fluid" alt="" width="100px">
                </li>
                <li class="list-group-item d-flex justify-content-between">
                <span>Total </span>
                <strong>Rp. <span>{{ $total }}</span></strong>
                </li>
            </ul>
          </div>
          <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Pembayaran</h4>
          <form action="" method="post">
            @csrf
            <div class="row form-group mb-3">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                        placeholder="Masukkan Nama Depan" value="{{ Auth::user()->first_name }}" disabled>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6 mb-sm-0">
                    <input type="text" class="form-control form-control-user @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                        placeholder="Masukkan Nama Belakang" value="{{ Auth::user()->last_name }}" disabled>
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-3">
                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email"
                    placeholder="Masukkan Alamat Email" value="{{  Auth::user()->email }}" disabled>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                  <input type="text" class="form-control form-control-user @error('no_personal') is-invalid @enderror"
                        id="no_personal" name="no_personal" placeholder="Masukkan Nomor Telepon Personal" value="{{ Auth::user()->no_personal }}" disabled>
                    @error('no_personal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <button id="pay-button" class="btn" style="color: white;background-color:#2753d7" type="submit">
              checkout
            </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  @endsection
  <script type="text/javascript">
    console.log('{{$snapToken}}');
    // For example trigger on button clicked, or any time you need
    document.addEventListener('DOMContentLoaded', function() {
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // Prevent the default form submission behavior
            event.preventDefault();
            // Call the function to get the transaction token
            window.snap.pay('{{$snapToken}}', {
                onSuccess: function (result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    console.log(result);
                },
                onPending: function (result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function (result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function () {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            });
        });

        // Function to delete payment data using AJAX
        function deletePaymentData() {
            // Menggunakan AJAX untuk mengirim permintaan ke server
            $.ajax({
                url: '{{ route('delete_payment') }}', // Ganti dengan URL endpoint yang sesuai untuk menghapus data pembayaran
                type: 'GET', // Ganti dengan metode HTTP yang sesuai (misalnya 'GET', 'POST', 'DELETE', 'PUT', dll.)
                success: function (response) {
                    // Jika permintaan berhasil, Anda bisa menangani respon di sini (opsional).
                    console.log('Data pembayaran berhasil dihapus!');
                },
                error: function (xhr, status, error) {
                    // Jika terjadi kesalahan saat mengirim permintaan, Anda bisa menangani error di sini (opsional).
                    console.error('Terjadi kesalahan saat menghapus data pembayaran:', error);
                }
            });
        }

        // Example usage of the deletePaymentData function, triggered by some action (e.g., clicking a button)
        var cancelButton = document.getElementById('cancel-button');
        cancelButton.addEventListener('click', function () {
            // Call the function to delete payment data
            deletePaymentData();
        });
    });
</script>


