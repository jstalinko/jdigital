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