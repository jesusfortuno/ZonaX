<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-section about">
                <h3 class="footer-title">Sobre ZonaX</h3>
                <p>Tu tienda online de confianza para productos de calidad. Ofrecemos una amplia selección con los mejores precios y envío rápido.</p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="footer-section links">
                <h3 class="footer-title">Enlaces Rápidos</h3>
                <ul>
                    <li><a href="?action=portada">Inicio</a></li>
                    <li><a href="?action=llistar-productes">Productos</a></li>
                    <li><a href="#">Sobre Nosotros</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li><a href="#">Política de Privacidad</a></li>
                </ul>
            </div>
            
            <div class="footer-section contact">
                <h3 class="footer-title">Contacto</h3>
                <p><i class="fas fa-map-marker-alt"></i> Calle Principal 123, Barcelona</p>
                <p><i class="fas fa-phone"></i> +34 123 456 789</p>
                <p><i class="fas fa-envelope"></i> info@zonax.com</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> ZonaX. Todos los derechos reservados.</p>
            <p class="payment-methods">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-amex"></i>
            </p>
        </div>
    </div>
</footer>

<style>
    .site-footer {
        background-color: #1f2937;
        color: #d1d5db;
        padding: 3rem 0 1.5rem;
        font-size: 0.9rem;
        line-height: 1.6;
    }
    
    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    
    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    .footer-title {
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1.25rem;
        position: relative;
        padding-bottom: 0.5rem;
    }
    
    .footer-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 2px;
        background: linear-gradient(90deg, #ff6b6b, #ffa36b);
    }
    
    .footer-section p {
        margin-bottom: 1rem;
    }
    
    .social-links {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.25rem;
    }
    
    .social-links a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background-color: #374151;
        color: #ffffff;
        border-radius: 50%;
        transition: all 0.2s ease;
    }
    
    .social-links a:hover {
        background: linear-gradient(90deg, #ff6b6b, #ffa36b);
        transform: translateY(-3px);
    }
    
    .footer-section.links ul {
        list-style: none;
        padding: 0;
    }
    
    .footer-section.links li {
        margin-bottom: 0.75rem;
    }
    
    .footer-section.links a {
        color: #d1d5db;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
    }
    
    .footer-section.links a:hover {
        color: #fca5a5;
        transform: translateX(5px);
    }
    
    .footer-section.links a::before {
        content: '›';
        margin-right: 0.5rem;
        color: #ff6b6b;
    }
    
    .footer-section.contact p {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .footer-section.contact i {
        color: #fca5a5;
        font-size: 1rem;
        width: 20px;
    }
    
    .footer-bottom {
        border-top: 1px solid #374151;
        padding-top: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .payment-methods {
        display: flex;
        gap: 0.75rem;
        font-size: 1.5rem;
    }
    
    .payment-methods i {
        color: #9ca3af;
        transition: all 0.2s ease;
    }
    
    .payment-methods i:hover {
        color: #ffffff;
    }
    
    @media (max-width: 768px) {
        .footer-content {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .footer-bottom {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
