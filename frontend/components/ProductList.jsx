import React, { useState, useMemo } from 'react';

const MOCK_PRODUCTS = [
  { id: 1, name: 'Premium Leather Boots', price: 129.99, category: 'Footwear', image: 'https://images.unsplash.com/photo-1520639889413-5b5586a75fb3?w=500&q=80' },
  { id: 2, name: 'Cotton Crewneck Tee', price: 24.50, category: 'Apparel', image: 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=500&q=80' },
  { id: 3, name: 'Minimalist Watch', price: 89.00, category: 'Accessories', image: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&q=80' },
  { id: 4, name: 'Canvas Backpack', price: 55.00, category: 'Accessories', image: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=500&q=80' },
  { id: 5, name: 'Denim Jacket', price: 79.99, category: 'Apparel', image: 'https://images.unsplash.com/photo-1527010150264-770001dbdf1f?w=500&q=80' },
  { id: 6, name: 'Running Sneakers', price: 110.00, category: 'Footwear', image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500&q=80' },
  { id: 7, name: 'Silk Scarf', price: 35.00, category: 'Accessories', image: 'https://images.unsplash.com/photo-1520903920243-00d872a2d1c9?w=500&q=80' },
  { id: 8, name: 'Chino Trousers', price: 49.00, category: 'Apparel', image: 'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?w=500&q=80' },
  { id: 9, name: 'Leather Wallet', price: 45.00, category: 'Accessories', image: 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=500&q=80' },
  { id: 10, name: 'Wool Beanie', price: 18.00, category: 'Accessories', image: 'https://images.unsplash.com/photo-1576871337632-b9aef4c17ab9?w=500&q=80' },
];

const CATEGORIES = ['All', 'Apparel', 'Footwear', 'Accessories'];
const ITEMS_PER_PAGE = 6;

const ProductList = () => {
  const [activeCategory, setActiveCategory] = useState('All');
  const [currentPage, setCurrentPage] = useState(1);

  const filteredProducts = useMemo(() => {
    if (activeCategory === 'All') return MOCK_PRODUCTS;
    return MOCK_PRODUCTS.filter(product => product.category === activeCategory);
  }, [activeCategory]);

  const totalPages = Math.ceil(filteredProducts.length / ITEMS_PER_PAGE);
  
  const currentProducts = useMemo(() => {
    const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
    return filteredProducts.slice(startIndex, startIndex + ITEMS_PER_PAGE);
  }, [filteredProducts, currentPage]);

  const handleCategoryChange = (category) => {
    setActiveCategory(category);
    setCurrentPage(1);
  };

  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div className="flex flex-col md:flex-row md:items-center md:justify-between mb-8 space-y-4 md:space-y-0">
        <div>
          <h1 className="text-3xl font-bold text-gray-900 tracking-tight">Our Collection</h1>
          <p className="mt-2 text-sm text-gray-500">Showing {filteredProducts.length} high-quality products</p>
        </div>
        
        <div className="flex flex-wrap gap-2">
          {CATEGORIES.map((category) => (
            <button
              key={category}
              onClick={() => handleCategoryChange(category)}
              className={`px-4 py-2 text-sm font-medium rounded-full transition-colors duration-200 ${
                activeCategory === category
                  ? 'bg-indigo-600 text-white shadow-sm'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              {category}
            </button>
          ))}
        </div>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-10">
        {currentProducts.map((product) => (
          <div key={product.id} className="group relative flex flex-col">
            <div className="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
              <img
                src={product.image}
                alt={product.name}
                className="h-72 w-full object-cover object-center group-hover:opacity-75 transition-opacity duration-300"
              />
            </div>
            <div className="mt-4 flex justify-between items-start">
              <div>
                <h3 className="text-sm text-gray-700 font-medium">
                  <a href="#">
                    <span aria-hidden="true" className="absolute inset-0" />
                    {product.name}
                  </a>
                </h3>
                <p className="mt-1 text-sm text-gray-500">{product.category}</p>
              </div>
              <p className="text-sm font-semibold text-gray-900">${product.price.toFixed(2)}</p>
            </div>
            <button className="mt-4 w-full bg-white border border-gray-300 py-2 px-4 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors z-10">
              Add to Cart
            </button>
          </div>
        ))}
      </div>

      {totalPages > 1 && (
        <div className="mt-12 flex items-center justify-center border-t border-gray-200 pt-8">
          <nav className="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
            <button
              onClick={() => setCurrentPage(prev => Math.max(prev - 1, 1))}
              disabled={currentPage === 1}
              className="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span className="sr-only">Previous</span>
              <svg className="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fillRule="evenodd" d="M12.79 5.23a.75.75 0 01.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clipRule="evenodd" />
              </svg>
            </button>
            
            {[...Array(totalPages)].map((_, idx) => (
              <button
                key={idx + 1}
                onClick={() => setCurrentPage(idx + 1)}
                className={`relative inline-flex items-center px-4 py-2 text-sm font-semibold focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ${
                  currentPage === idx + 1
                    ? 'z-10 bg-indigo-600 text-white'
                    : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50'
                }`}
              >
                {idx + 1}
              </button>
            ))}

            <button
              onClick={() => setCurrentPage(prev => Math.min(prev + 1, totalPages))}
              disabled={currentPage === totalPages}
              className="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span className="sr-only">Next</span>
              <svg className="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fillRule="evenodd" d="M7.21 14.77a.75.75 0 01-.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clipRule="evenodd" />
              </svg>
            </button>
          </nav>
        </div>
      )}
    </div>
  );
};

export default ProductList;