import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { useToast } from 'vue-toastification'

export const useCartStore = defineStore('cart', () => {
  const toast = useToast()
  const items = ref([])

  // Load items from localStorage on store initialization
  const loadItems = () => {
    const savedItems = localStorage.getItem('cartItems')
    if (savedItems) {
      items.value = JSON.parse(savedItems)
    }
  }

  // Save items to localStorage
  const saveItems = () => {
    localStorage.setItem('cartItems', JSON.stringify(items.value))
  }

  // Add item to cart
  const addItem = (product) => {
    const existingItem = items.value.find(item => item.id === product.id)
    if (existingItem) {
      existingItem.quantity++
    } else {
      items.value.push({ ...product, quantity: 1 })
    }
    saveItems()
    toast.success("Item added to cart")
  }

  // Remove item from cart
  const removeItem = (productId) => {
    items.value = items.value.filter(item => item.id !== productId)
    saveItems()
    toast.success("Item removed from cart")
  }

  // Update item quantity
  const updateQuantity = (productId, quantity) => {
    const item = items.value.find(item => item.id === productId)
    if (item) {
      item.quantity = quantity
      saveItems()
      toast.info("Cart updated")
    }
  }

  // Compute total price
  const totalPrice = computed(() => {
    return items.value.reduce((total, item) => total + item.price * item.quantity, 0)
  })

  // Initialize store
  loadItems()

  return { items, addItem, removeItem, updateQuantity, totalPrice }
})