<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Denda</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <h1>Pembayaran Denda</h1>
    <form id="payment-form">
        <label for="amount">Jumlah Denda:</label>
        <input type="number" id="amount" name="amount" required>
        <button type="button" id="pay-button">Bayar</button>
    </form>

    <script>
        $(document).ready(function () {
            $('#pay-button').on('click', function () {
                var amount = $('#amount').val();

                $.ajax({
                    url: '{{ route('payment.pay') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        amount: amount
                    },
                    success: function (response) {
                        var snapToken = response.snapToken;
                        snap.pay(snapToken, {
                            onSuccess: function (result) {
                                Swal.fire("Berhasil!", "Pembayaran berhasil dilakukan.", "success");
                            },
                            onPending: function (result) {
                                Swal.fire("Menunggu!", "Pembayaran sedang menunggu konfirmasi.", "info");
                            },
                            onError: function (result) {
                                Swal.fire("Gagal!", "Terjadi kesalahan saat melakukan pembayaran.", "error");
                            }
                        });
                    },
                    error: function () {
                        Swal.fire("Gagal!", "Terjadi kesalahan saat melakukan pembayaran.", "error");
                    }
                });
            });
        });
    </script>
</body>
</html>
