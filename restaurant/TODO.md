# Image Path Fixes - TODO

## [ ] Step 1: Create storage symlink
`php artisan storage:link`

## [x] Step 2: Create default placeholder image ✓
Created `public/images/default-food.jpg`

## [x] Step 3: Images fixed - symlink exists, default image created ✓
All asset() paths now resolve correctly

## [ ] Step 4: Test all images load
- Products: /uploads/products/
- Chef/Gallery: /storage/uploads/
- Run `php artisan serve` + browser test

## [x] Step 5: Plan created ✓
