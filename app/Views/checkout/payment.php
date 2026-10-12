<div class="checkout-payment-container">
    <div class="page-header">
        <h1>Secure Payment</h1>
        <p>Order Reference: <strong><?= e($orderNumber) ?></strong></p>
    </div>

    <div class="payment-card">
        <div class="payment-amount-box">
            <span>Amount Due</span>
            <h2>₹<?= number_format((float)$amount, 2) ?></h2>
        </div>

        <form id="razorpayForm" action="<?= url('/payment/verify') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="order_id" value="<?= e($orderId) ?>">
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="<?= e($gatewayOrderId) ?>">
            <input type="hidden" name="razorpay_signature" id="razorpay_signature">

            <div class="payment-button-wrapper">
                <button type="button" id="rzp-button" class="btn btn-primary btn-block">Pay with Razorpay</button>
            </div>
        </form>

        <p class="secure-notice">256-bit SSL encrypted transaction via Razorpay Payment Gateway.</p>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.getElementById('rzp-button').onclick = function(e){
    var options = {
        "key": "<?= e($razorpayKey) ?>",
        "amount": "<?= (int)($amount * 100) ?>",
        "currency": "INR",
        "name": "Website-to-App Converter",
        "description": "Mobile App Conversion Package",
        "order_id": "<?= e($gatewayOrderId) ?>",
        "handler": function (response){
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            document.getElementById('razorpayForm').submit();
        },
        "theme": {
            "color": "#4f46e5"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();
}
</script>
