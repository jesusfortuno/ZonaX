<footer class="footer">
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-column">
                <h3 class="footer-title">Zona</h3>
                <p class="footer-description">
                    Tu tienda online de confianza para productos de calidad. Ofrecemos una amplia selección de artículos con envío rápido y atención personalizada.
                </p>
                <div class="footer-social">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="footer-column">
                <h3 class="footer-title">Enlaces rápidos</h3>
                <ul class="footer-links">
                    <li><a href="?action=portada">Inicio</a></li>
                    <li><a href="?action=llistar-productes">Productos</a></li>
                    <li><a href="?action=categorias">Categorías</a></li>
                    <li><a href="?action=perfil">Mi cuenta</a></li>
                    <li><a href="?action=carrito">Carrito</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3 class="footer-title">Información</h3>
                <ul class="footer-links">
                    <li><a href="#">Sobre nosotros</a></li>
                    <li><a href="#">Política de privacidad</a></li>
                    <li><a href="#">Términos y condiciones</a></li>
                    <li><a href="#">Política de devoluciones</a></li>
                    <li><a href="#">Preguntas frecuentes</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3 class="footer-title">Contacto</h3>
                <ul class="footer-contact">
                    <li><i class="fas fa-map-marker-alt"></i> Calle Principal 123, Barcelona</li>
                    <li><i class="fas fa-phone"></i> +34 123 456 789</li>
                    <li><i class="fas fa-envelope"></i> info@zonax.com</li>
                    <li><i class="fas fa-clock"></i> Lun - Vie: 9:00 - 18:00</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="payment-methods">
                <h4>Métodos de pago</h4>
                <div class="payment-icons">
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-paypal"></i>
                    <i class="fab fa-cc-amex"></i>
                    <i class="fab fa-cc-apple-pay"></i>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; <?= date('Y'); ?> Zona. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
        background-color: var(--color-gray-800);
        color: var(--color-gray-300);
        padding: 3rem 0 1rem;
        margin-top: 4rem;
    }
    
    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    
    .footer-top {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    .footer-column {
        display: flex;
        flex-direction: column;
    }
    
    .footer-title {
        color: var(--color-white);
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1.2rem;
        position: relative;
        padding-bottom: 0.8rem;
    }
    
    .footer-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--gradient-main);
        border-radius: 2px;
    }
    
    .footer-description {
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }
    
    .footer-social {
        display: flex;
        gap: 1rem;
    }
    
    .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
        color: var(--color-white);
        font-size: 1rem;
        transition: var(--transition-fast);
    }
    
    .social-link:hover {
        background-color: var(--color-primary);
        transform: translateY(-3px);
    }
    
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer-links li {
        margin-bottom: 0.8rem;
    }
    
    .footer-links a {
        color: var(--color-gray-300);
        text-decoration: none;
        font-size: 0.9rem;
        transition: var(--transition-fast);
        display: inline-flex;
        align-items: center;
    }
    
    .footer-links a::before {
        content: '\f105';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        margin-right: 0.5rem;
        color: var(--color-primary);
        transition: var(--transition-fast);
        font-size: 0.8rem;
    }
    
    .footer-links a:hover {
        color: var(--color-primary);
        transform: translateX(3px);
    }
    
    .footer-links a:hover::before {
        transform: translateX(2px);
    }
    
    .footer-contact {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer-contact li {
        display: flex;
        align-items: flex-start;
        gap: 0.8rem;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }
    
    .footer-contact li i {
        color: var(--color-primary);
        font-size: 1rem;
        margin-top: 0.2rem;
    }
    
    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 2rem;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 1.5rem;
    }
    
    .payment-methods h4 {
        font-size: 0.9rem;
        color: var(--color-white);
        margin-bottom: 0.8rem;
        font-weight: 500;
    }
    
    .payment-icons {
        display: flex;
        gap: 1rem;
        font-size: 1.8rem;
        color: var(--color-gray-400);
    }
    
    .copyright {
        font-size: 0.85rem;
        color: var(--color-gray-400);
    }
    
    @media (max-width: 768px) {
        .footer-top {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        
        .footer-bottom {
            flex-direction: column;
            align-items: flex-start;
            gap: 1.5rem;
        }
    }
</style>
