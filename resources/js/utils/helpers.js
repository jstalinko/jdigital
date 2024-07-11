// resources/js/utils/helpers.js
import Cookies from "js-cookie";

export function isFavorite(id) {
    let favorites = Cookies.get("favorites");
    favorites = favorites ? JSON.parse(favorites) : [];
    return favorites.some(fav => fav.id === id);
}
export function toggleFavorite(id, name, slug) {
    let favorites = Cookies.get("favorites");
    favorites = favorites ? JSON.parse(favorites) : [];

    const index = favorites.findIndex(fav => fav.id === id && fav.name === name && fav.slug === slug);

    if (index !== -1) {
        // Remove from favorites
        favorites.splice(index, 1);
    } else {
        // Add to favorites
        favorites.push({ id, name, slug });
    }

    Cookies.set("favorites", JSON.stringify(favorites), { expires: 7 });

    return favorites;
}
export function loadFavorites() {
    let favorites = Cookies.get("favorites");
    return favorites ? JSON.parse(favorites) : [];
}

export function formatCurrency(amount) {
    return new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "IDR",
        currencyDisplay: "narrowSymbol",
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    }).format(amount);
}

export function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
export function stripTags(html) {
    // Menghapus semua tag HTML dari teks yang diberikan
    return html.replace(/<[^>]*>?/gm, "");
}
export function calculateFee(price, fee_merchant, fee_customer) {
    // Cek apakah semua nilai fee_merchant adalah 0
    const isMerchantFeeZero =
        fee_merchant.flat === 0 && fee_merchant.percent === 0;

    // Pilih fee yang akan digunakan berdasarkan pengecekan di atas
    const fee = isMerchantFeeZero ? fee_customer : fee_merchant;

    // Hitung total fee
    const totalFee = fee.flat + (price * fee.percent) / 100;
    return totalFee;
}
export function imageUrl(string) {
    const urlPattern = /^(http|https):\/\//i;
    
    // Check if the string matches the regular expression
    if (urlPattern.test(string)) {
        return string;
    } else {
        return '/storage/' + string;
    }
}
