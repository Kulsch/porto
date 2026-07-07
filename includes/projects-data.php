<?php
/**
 * projects-data.php
 * -----------------------------------------------------------------------
 * Acts as a lightweight "Model" layer. In a production build this would
 * pull from a database; here it's a structured array so the whole site
 * runs without external dependencies. Included by index.php & projects.php.
 * -----------------------------------------------------------------------
 */

$projects = [
    [
        'title'    => 'Nimbus Analytics',
        'category' => 'Web App',
        'summary'  => 'A real-time analytics dashboard with custom charting and role-based access control.',
        'image'    => ASSETS_PATH . '/images/projects/nimbus.jpg',
        'tags'     => ['PHP', 'MySQL', 'Chart.js', 'JavaScript'],
        'github'   => 'https://github.com/',
        'demo'     => 'https://example.com/',
    ],
    [
        'title'    => 'Fintra — Personal Finance',
        'category' => 'Mobile',
        'summary'  => 'A budgeting app with automated categorization and predictive spend insights.',
        'image'    => ASSETS_PATH . '/images/projects/fintra.jpg',
        'tags'     => ['React Native', 'Node.js', 'PostgreSQL'],
        'github'   => 'https://github.com/',
        'demo'     => 'https://example.com/',
    ],
    [
        'title'    => 'Studio Kit — Design System',
        'category' => 'UI/UX',
        'summary'  => 'A component library and design token system used across six product teams.',
        'image'    => ASSETS_PATH . '/images/projects/studiokit.jpg',
        'tags'     => ['Figma', 'CSS', 'Storybook'],
        'github'   => 'https://github.com/',
        'demo'     => 'https://example.com/',
    ],
    [
        'title'    => 'Pulse — E-commerce Platform',
        'category' => 'Web App',
        'summary'  => 'A headless storefront with sub-second page loads and a custom checkout flow.',
        'image'    => ASSETS_PATH . '/images/projects/pulse.jpg',
        'tags'     => ['PHP', 'Vue', 'Redis'],
        'github'   => 'https://github.com/',
        'demo'     => 'https://example.com/',
    ],
    [
        'title'    => 'Wayfarer — Travel Planner',
        'category' => 'Mobile',
        'summary'  => 'An itinerary planner with offline maps and collaborative trip boards.',
        'image'    => ASSETS_PATH . '/images/projects/wayfarer.jpg',
        'tags'     => ['Flutter', 'Firebase'],
        'github'   => 'https://github.com/',
        'demo'     => 'https://example.com/',
    ],
    [
        'title'    => 'Motion Lab — Brand Identity',
        'category' => 'UI/UX',
        'summary'  => 'Brand system and motion guidelines for a creative technology studio.',
        'image'    => ASSETS_PATH . '/images/projects/motionlab.jpg',
        'tags'     => ['Illustrator', 'After Effects'],
        'github'   => 'https://github.com/',
        'demo'     => 'https://example.com/',
    ],
];
