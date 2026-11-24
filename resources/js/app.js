import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);

// Global Cart Store
Alpine.store('cart', {
    items: [],
    isOpen: false,
    toastMessage: '',
    toastVisible: false,

    init() {
        const saved = localStorage.getItem('inas_cart');
        if (saved) {
            try {
                this.items = JSON.parse(saved);
            } catch (e) {
                this.items = [];
            }
        }
    },

    save() {
        localStorage.setItem('inas_cart', JSON.stringify(this.items));
    },

    toggle() {
        this.isOpen = !this.isOpen;
    },

    open() {
        this.isOpen = true;
    },

    close() {
        this.isOpen = false;
    },

    showToast(msg) {
        this.toastMessage = msg;
        this.toastVisible = true;
        setTimeout(() => {
            this.toastVisible = false;
        }, 3200);
    },

    addItem(product) {
        // product: { id, name, slug, image, pack_size, price, quantity }
        const packSize = product.pack_size || '100g';
        const qty = parseInt(product.quantity || 1, 10);
        const price = parseFloat(product.price);

        const existing = this.items.find(i => i.id === product.id && i.pack_size === packSize);

        if (existing) {
            existing.quantity += qty;
        } else {
            this.items.push({
                id: product.id,
                name: product.name,
                slug: product.slug,
                image: product.image,
                pack_size: packSize,
                price: price,
                quantity: qty,
            });
        }

        this.save();
        this.showToast(`Added ${qty}x ${product.name} (${packSize}) to your bag`);
        this.isOpen = true;
    },

    updateQuantity(id, packSize, delta) {
        const item = this.items.find(i => i.id === id && i.pack_size === packSize);
        if (!item) return;

        item.quantity += delta;
        if (item.quantity <= 0) {
            this.removeItem(id, packSize);
        } else {
            this.save();
        }
    },

    removeItem(id, packSize) {
        this.items = this.items.filter(i => !(i.id === id && i.pack_size === packSize));
        this.save();
    },

    clearCart() {
        this.items = [];
        this.save();
    },

    get count() {
        return this.items.reduce((sum, item) => sum + item.quantity, 0);
    },

    get subtotal() {
        return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    },

    get formattedSubtotal() {
        return 'TZS ' + Number(this.subtotal).toLocaleString('en-US');
    },

    get freeDeliveryThreshold() {
        return 50000;
    },

    get freeDeliveryRemaining() {
        const remaining = this.freeDeliveryThreshold - this.subtotal;
        return remaining > 0 ? remaining : 0;
    },

    get freeDeliveryProgress() {
        const pct = (this.subtotal / this.freeDeliveryThreshold) * 100;
        return Math.min(100, Math.round(pct));
    },

    generateWhatsAppLink(customer = {}) {
        const phone = '255682869629';
        let msg = `*NEW ORDER - INAS PREMIUM BEEF BILTONG*\n`;
        msg += `------------------------------------\n`;
        if (customer.name) msg += `*Customer:* ${customer.name}\n`;
        if (customer.phone) msg += `*Phone:* ${customer.phone}\n`;
        if (customer.delivery_area) msg += `*Delivery Area:* ${customer.delivery_area}, Dar es Salaam\n`;
        if (customer.notes) msg += `*Notes:* ${customer.notes}\n`;
        msg += `\n*Ordered Items:*\n`;

        this.items.forEach(item => {
            const lineTotal = item.price * item.quantity;
            msg += `• ${item.name} (${item.pack_size}) x${item.quantity} = TZS ${Number(lineTotal).toLocaleString()}\n`;
        });

        msg += `\n*Subtotal:* TZS ${Number(this.subtotal).toLocaleString()}\n`;
        const deliveryFee = this.subtotal >= 50000 ? 0 : 5000;
        msg += `*Estimated Delivery:* ${deliveryFee === 0 ? 'FREE (Dar es Salaam)' : 'TZS 5,000 (Dar es Salaam)'}\n`;
        msg += `*Total Due:* TZS ${Number(this.subtotal + deliveryFee).toLocaleString()}\n`;
        msg += `\n_Please confirm availability and dispatch time. Thank you!_`;

        return `https://wa.me/${phone}?text=${encodeURIComponent(msg)}`;
    }
});

window.Alpine = Alpine;
Alpine.start();
