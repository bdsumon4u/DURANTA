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

export function addToCart(product, quantity, campaign) {
    axios.post(route('api.cart.add', product.id), {
        quantity: quantity,
        campaign: campaign,
    })
        .then(({data}) => {
            this.emitter.emit('cart-updated', data.success)
        })
        .catch(err => console.log(err));
}

export function updateCart(product, type) {
    axios.post(route('api.cart.update', {
        rowId: product.rowId,
        product: product.id,
        qty: product.qty,
        type,
    })).then(({data}) => {
        if (data.success) {
            this.emitter.emit('cart-updated', data.success);
        }
    }).catch(err => console.error(err));
}
