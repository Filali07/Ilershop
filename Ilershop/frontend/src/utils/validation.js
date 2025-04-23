// Validaciones básicas
export const validateEmail = (email) => {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  };
  
  export const validatePassword = (password) => {
    return password.length >= 6;
  };
  
  // Validación de formulario de producto
  export const validateProduct = (product) => {
    const errors = {};
    
    if (!product.name) errors.name = 'El nombre es requerido';
    if (product.price <= 0) errors.price = 'El precio debe ser mayor a 0';
    if (product.stock < 0) errors.stock = 'El stock no puede ser negativo';
  
    return {
      isValid: Object.keys(errors).length === 0,
      errors
    };
  };
  
  // Uso en componentes:
  // import { validateEmail, validateProduct } from '@/utils/validation';