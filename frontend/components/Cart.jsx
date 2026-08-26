'use client'

import React, { useEffect, useMemo, useState } from 'react'

const CURRENCY = 'USD'
const LOCALE = 'en-US'
const STORAGE_KEY = 'shopping_cart_v1'
const TAX_RATE = 0.08 // 8% example; adjustable
const FREE_SHIPPING_THRESHOLD = 100
const SHIPPING_FLAT = 6.99

const formatCurrency = (value) =>
  new Intl.NumberFormat(LOCALE, { style: 'currency', currency: CURRENCY }).format(value)

const sampleCatalog = [
  { id: 'p-101', name: 'Classic Tee', price: 24.99, variant: 'Black - M' },
  { id: 'p-102', name: 'Vintage Hoodie', price: 54.5, variant: 'Grey - L' },
  { id: 'p-103', name: 'Sneaker Socks (3-pack)', price: 9.99, variant: 'White' },
  { id: 'p-104', name: 'Leather Belt', price: 29.0, variant: 'Brown - 32' },
]

export default function Cart({ initialItems = [] }) {
  const [cart, setCart] = useState(() => {
    try {
      if (typeof window === 'undefined') return initialItems
      const raw = window.localStorage.getItem(STORAGE_KEY)
      if (raw) {
        return JSON.parse(raw)
      }
      return initialItems
    } catch {
      return initialItems
    }
  })

  // Sync with localStorage
  useEffect(() => {
    try {
      window.localStorage.setItem(STORAGE_KEY, JSON.stringify(cart))
    } catch {}
  }, [cart])

  // Add item to cart; if exists increase quantity
  const addToCart = (product, qty = 1) => {
    setCart((prev) => {
      const idx = prev.findIndex((it) => it.id === product.id)
      if (idx >= 0) {
        const next = [...prev]
        next[idx] = { ...next[idx], quantity: Math.min(999, next[idx].quantity + qty) }
        return next
      }
      return [...prev, { ...product, quantity: Math.max(1, Math.floor(qty)) }]
    })
  }

  const removeFromCart = (id) => {
    setCart((prev) => prev.filter((it) => it.id !== id))
  }

  const updateQuantity = (id, quantity) => {
    const q = Math.max(1, Math.min(999, Math.floor(Number.isNaN(Number(quantity)) ? 1 : Number(quantity))))
    setCart((prev) => prev.map((it) => (it.id === id ? { ...it, quantity: q } : it)))
  }

  const increment = (id) => {
    setCart((prev) => prev.map((it) => (it.id === id ? { ...it, quantity: Math.min(999, it.quantity + 1) } : it)))
  }

  const decrement = (id) => {
    setCart((prev) =>
      prev
        .map((it) => (it.id === id ? { ...it, quantity: Math.max(1, it.quantity - 1) } : it))
        .filter(Boolean)
    )
  }

  const clearCart = () => setCart([])

  const subtotal = useMemo(() => cart.reduce((s, it) => s + it.price * it.quantity, 0), [cart])
  const tax = useMemo(() => Math.round(subtotal * TAX_RATE * 100) / 100, [subtotal])
  const shipping = useMemo(() => (subtotal === 0 ? 0 : subtotal >= FREE_SHIPPING_THRESHOLD ? 0 : SHIPPING_FLAT), [subtotal])
  const total = useMemo(() => Math.round((subtotal + tax + shipping) * 100) / 100, [subtotal, tax, shipping])

  return (
    <div className="max-w-5xl mx-auto p-4">
      <div className="flex flex-col md:flex-row gap-6">
        <section className="md:w-1/2 bg-white shadow rounded-lg p-4">
          <h2 className="text-lg font-semibold mb-3">Catalog</h2>
          <ul className="space-y-3">
            {sampleCatalog.map((product) => (
              <li
                key={product.id}
                className="flex items-center justify-between gap-3 border rounded p-3 hover:shadow-sm transition"
              >
                <div className="flex items-center gap-3">
                  <div
                    aria-hidden
                    className="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-pink-500 flex items-center justify-center text-white font-bold"
                  >
                    {product.name
                      .split(' ')
                      .map((s) => s[0])
                      .join('')
                      .slice(0, 2)
                      .toUpperCase()}
                  </div>
                  <div>
                    <div className="font-medium text-sm">{product.name}</div>
                    <div className="text-xs text-gray-500">{product.variant}</div>
                  </div>
                </div>
                <div className="flex items-center gap-3">
                  <div className="text-sm font-medium">{formatCurrency(product.price)}</div>
                  <button
                    onClick={() => addToCart(product, 1)}
                    className="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                  >
                    Add
                  </button>
                </div>
              </li>
            ))}
          </ul>

          <div className="mt-6 border-t pt-4">
            <h3 className="text-sm font-semibold">Quick Add</h3>
            <QuickAdd onAdd={(p) => addToCart(p, p.quantity)} />
          </div>
        </section>

        <section className="md:w-1/2 bg-white shadow rounded-lg p-4 flex flex-col">
          <div className="flex items-start justify-between">
            <h2 className="text-lg font-semibold">Your Cart</h2>
            <div className="text-sm text-gray-600">{cart.length} item(s)</div>
          </div>

          {cart.length === 0 ? (
            <div className="mt-6 text-center text-gray-500">
              <p className="mb-3">Your cart is empty.</p>
              <button
                onClick={() => addToCart(sampleCatalog[0], 1)}
                className="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded text-sm"
              >
                Add sample item
              </button>
            </div>
          ) : (
            <>
              <ul className="mt-4 space-y-3 flex-1 overflow-auto">
                {cart.map((item) => (
                  <li key={item.id} className="flex items-center justify-between gap-3 border rounded p-3">
                    <div className="flex items-center gap-3 min-w-0">
                      <div
                        className="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 font-semibold flex-shrink-0"
                        aria-hidden
                      >
                        {item.name
                          .split(' ')
                          .map((s) => s[0])
                          .join('')
                          .slice(0, 2)
                          .toUpperCase()}
                      </div>
                      <div className="min-w-0">
                        <div className="text-sm font-medium truncate">{item.name}</div>
                        <div className="text-xs text-gray-500 truncate">{item.variant}</div>
                      </div>
                    </div>

                    <div className="flex items-center gap-3">
                      <div className="flex items-center border rounded">
                        <button
                          aria-label={`Decrease quantity of ${item.name}`}
                          onClick={() => decrement(item.id)}
                          className="px-2 py-1 text-gray-600 hover:bg-gray-100 focus:outline-none"
                        >
                          −
                        </button>
                        <input
                          aria-label={`Quantity for ${item.name}`}
                          type="number"
                          min="1"
                          max="999"
                          value={item.quantity}
                          onChange={(e) => updateQuantity(item.id, e.target.value)}
                          className="w-14 text-center text-sm focus:outline-none"
                        />
                        <button
                          aria-label={`Increase quantity of ${item.name}`}
                          onClick={() => increment(item.id)}
                          className="px-2 py-1 text-gray-600 hover:bg-gray-100 focus:outline-none"
                        >
                          +
                        </button>
                      </div>

                      <div className="text-sm font-medium w-20 text-right">{formatCurrency(item.price * item.quantity)}</div>

                      <button
                        onClick={() => removeFromCart(item.id)}
                        className="ml-2 text-red-500 text-sm hover:underline focus:outline-none"
                      >
                        Remove
                      </button>
                    </div>
                  </li>
                ))}
              </ul>

              <div className="mt-4 border-t pt-4">
                <div className="flex justify-between text-sm">
                  <span>Subtotal</span>
                  <span>{formatCurrency(subtotal)}</span>
                </div>
                <div className="flex justify-between text-sm mt-1">
                  <span>Tax ({Math.round(TAX_RATE * 100)}%)</span>
                  <span>{formatCurrency(tax)}</span>
                </div>
                <div className="flex justify-between text-sm mt-1">
                  <span>Shipping</span>
                  <span>{shipping === 0 ? 'Free' : formatCurrency(shipping)}</span>
                </div>

                <div className="flex justify-between items-center mt-3 pt-3 border-t">
                  <div>
                    <div className="text-sm text-gray-600">Total</div>
                    <div className="text-xl font-semibold">{formatCurrency(total)}</div>
                  </div>
                  <div className="flex items-center gap-2">
                    <button
                      onClick={clearCart}
                      className="px-3 py-2 bg-gray-100 rounded text-sm hover:bg-gray-200 focus:outline-none"
                    >
                      Clear
                    </button>
                    <button
                      onClick={() => alert('Checkout not implemented in demo')}
                      className="px-4 py-2 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700 focus:outline-none"
                    >
                      Checkout
                    </button>
                  </div>
                </div>
              </div>
            </>
          )}
        </section>
      </div>
    </div>
  )
}

function QuickAdd({ onAdd }) {
  const [name, setName] = useState('')
  const [variant, setVariant] = useState('')
  const [price, setPrice] = useState('')
  const [quantity, setQuantity] = useState(1)

  const isValid = name.trim() !== '' && !Number.isNaN(Number(price)) && Number(price) > 0 && Number(quantity) >= 1

  const createProduct = () => {
    const id = `custom-${Date.now()}-${Math.random().toString(36).slice(2, 8)}`
    return { id, name: name.trim(), variant: variant.trim(), price: Math.round(Number(price) * 100) / 100, quantity: Math.max(1, Math.floor(quantity)) }
  }

  const handleAdd = () => {
    if (!isValid) return
    const p = createProduct()
    onAdd(p)
    setName('')
    setVariant('')
    setPrice('')
    setQuantity(1)
  }

  return (
    <div className="mt-3">
      <div className="grid grid-cols-1 sm:grid-cols-2 gap-2">
        <input
          aria-label="Product name"
          value={name}
          onChange={(e) => setName(e.target.value)}
          placeholder="Name (required)"
          className="px-3 py-2 border rounded text-sm focus:outline-none"
        />
        <input
          aria-label="Variant"
          value={variant}
          onChange={(e) => setVariant(e.target.value)}
          placeholder="Variant (optional)"
          className="px-3 py-2 border rounded text-sm focus:outline-none"
        />
        <input
          aria-label="Price"
          value={price}
          onChange={(e) => setPrice(e.target.value)}
          placeholder="Price (e.g. 12.99)"
          className="px-3 py-2 border rounded text-sm focus:outline-none"
        />
        <input
          aria-label="Quantity"
          type="number"
          min="1"
          value={quantity}
          onChange={(e) => setQuantity(Math.max(1, Number(e.target.value) || 1))}
          className="px-3 py-2 border rounded text-sm focus:outline-none"
        />
      </div>
      <div className="mt-3 flex items-center gap-2">
        <button
          onClick={handleAdd}
          disabled={!isValid}
          className={`px-3 py-2 rounded text-sm ${isValid ? 'bg-green-600 text-white hover:bg-green-700' : 'bg-gray-100 text-gray-400 cursor-not-allowed'}`}
        >
          Add Custom
        </button>
        <button
          onClick={() => {
            setName('')
            setVariant('')
            setPrice('')
            setQuantity(1)
          }}
          className="px-3 py-2 bg-gray-50 rounded text-sm hover:bg-gray-100"
        >
          Reset
        </button>
      </div>
    </div>
  )
}