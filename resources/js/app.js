import './bootstrap';

// 1. Import Alpine and Plugins
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import collapse from '@alpinejs/collapse';

// 2. Register Plugins
Alpine.plugin(intersect);
Alpine.plugin(collapse);

// 3. Start Alpine
window.Alpine = Alpine;
Alpine.start();