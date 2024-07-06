// resources/js/utils/helpers.js

export function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'IDR',
        currencyDisplay: 'narrowSymbol',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    }).format(amount);
}


export function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
export function stripTags(html) {
    // Menghapus semua tag HTML dari teks yang diberikan
    return html.replace(/<[^>]*>?/gm, '');
}
export function calculateFee(price, fee_merchant, fee_customer) {
    // Cek apakah semua nilai fee_merchant adalah 0
    const isMerchantFeeZero = fee_merchant.flat === 0 && fee_merchant.percent === 0;
    
    // Pilih fee yang akan digunakan berdasarkan pengecekan di atas
    const fee = isMerchantFeeZero ? fee_customer : fee_merchant;
  
    // Hitung total fee
    const totalFee = fee.flat + (price * fee.percent / 100);
    return totalFee;
  }
  