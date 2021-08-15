export const ucfirst = str => str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
export const ucwords = (str, sep = ' ', join = ' ') => str.split(sep).map(word => ucfirst(word)).join(join);

export function calculateTotal(product) {
    return this.moneyFormat((product.pivot.price - product.pivot.discount) * product.pivot.quantity);
}

export function moneyFormat(amount) {
    return amount + ' TK';
    return amount.toLocaleString("en-US", {
        style: "currency",
        currency: "BDT"
    });
}
