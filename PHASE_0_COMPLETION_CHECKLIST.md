# ✅ PHASE 0: DATABASE & BACKEND SETUP CHECKLIST
**Date:** April 10, 2026  
**Project:** Ocean Lilly Tours Admin Portal  
**Status:** Ready for Execution  

---

## 📋 PRE-STARTUP CHECKLIST

### Before You Start
- [ ] **Read** PHASE_0_CPANEL_MANUAL_SETUP.md completely
- [ ] **Backup** current website:
  - [ ] Download database backup (.sql)
  - [ ] Download website files (.zip)
  - [ ] Store in 2 safe locations
- [ ] **Verify** you have:
  - [ ] cPanel login credentials
  - [ ] FTP/SSH access
  - [ ] Email credentials for SMTP
  - [ ] 2-3 hours of uninterrupted time
  - [ ] List of all values to update
- [ ] **Document** your setup:
  - [ ] Notated all credentials
  - [ ] Planned database names
  - [ ] Prepared admin user email/password

---

## 🔧 SETUP STEPS CHECKLIST

### STEP 1: Backup Current Website
- [ ] Backup database via phpMyAdmin
  - Database name: _______________
  - File saved as: _______________
  - Location: ____________________
  
- [ ] Backup website files
  - Total size: ___________________
  - File saved as: _______________
  - Location: ____________________

### STEP 2: Create MySQL Database & User
- [ ] Created new database: _______________
  - Full name (with prefix): ________________
  - Created at: _____/_____/________
  
- [ ] Created database user: _______________
  - Username: oceanlilly_admin
  - Password: ___________________
  - Created at: _____/_____/________
  
- [ ] Granted ALL PRIVILEGES
  - Verified: ☐ Yes ☐ No

### STEP 3: Laravel Directory Structure
- [ ] Created backend/ folder
- [ ] Created subdirectories:
  - [ ] app/
  - [ ] database/
  - [ ] routes/
  - [ ] resources/
  - [ ] config/
  - [ ] storage/
  - [ ] public/
  - [ ] vendor/
  - [ ] bootstrap/

- [ ] Created nested directories:
  - [ ] app/Http/
  - [ ] app/Http/Controllers/
  - [ ] app/Models/
  - [ ] database/migrations/
  - [ ] database/seeders/

### STEP 4: Install Laravel via Composer
- [ ] Downloaded composer.json
- [ ] Uploaded to backend/
- [ ] Ran: composer install
  - Duration: __________ minutes
  - Status: ☐ Success ☐ Failed
  - Errors: ____________________

### STEP 5: Configure .env File
- [ ] Downloaded .env.template
- [ ] Created .env file in backend/
- [ ] Updated values:
  - [ ] DB_DATABASE: _______________
  - [ ] DB_USERNAME: oceanlilly_admin
  - [ ] DB_PASSWORD: _______________
  - [ ] MAIL_HOST: _______________
  - [ ] MAIL_USERNAME: _______________
  - [ ] MAIL_PASSWORD: _______________
  - [ ] APP_URL: https://jerzy.lk/oceanlilly/backend
  
- [ ] Verified file permissions (644)
- [ ] Verified .env is not publicly accessible

### STEP 6: Setup /uploads Directory
- [ ] Created uploads/ folder
- [ ] Set permissions: 755
- [ ] Tested write access:
  - File test: _______________
  - Status: ☐ Success ☐ Failed

### STEP 7: Upload Migration Files
- [ ] Downloaded all 16 migration files
- [ ] Created migrations/ folder
- [ ] Uploaded all files to: backend/database/migrations/
  
  Files uploaded:
  - [ ] 2024_01_01_create_packages_table.php
  - [ ] 2024_01_02_create_categories_tour_table.php
  - [ ] 2024_01_03_create_blog_posts_table.php
  - [ ] 2024_01_04_create_categories_blog_table.php
  - [ ] 2024_01_05_create_gallery_images_table.php
  - [ ] 2024_01_06_create_testimonials_table.php
  - [ ] 2024_01_07_create_tripadvisor_reviews_table.php
  - [ ] 2024_01_08_create_hero_slides_table.php
  - [ ] 2024_01_09_create_inquiries_table.php
  - [ ] 2024_01_10_create_bookings_table.php
  - [ ] 2024_01_11_create_services_table.php
  - [ ] 2024_01_12_create_why_choose_us_table.php
  - [ ] 2024_01_13_create_about_us_table.php
  - [ ] 2024_01_14_create_footer_content_table.php
  - [ ] 2024_01_15_create_navbar_items_table.php
  - [ ] 2024_01_16_create_partners_table.php
  - [ ] 2024_01_17_create_seo_pages_table.php
  - [ ] 2024_01_18_create_settings_table.php
  - [ ] 2024_01_19_create_admin_users_table.php
  - [ ] 2024_01_20_create_admin_audit_log_table.php

### STEP 8: Run Migrations
- [ ] **Option A: Via SSH**
  - [ ] $ php artisan migrate
  - [ ] All 16 migrations ran
  - [ ] Status: ☐ Success ☐ Failed
  
- [ ] **Option B: Via Web**
  - [ ] Downloaded migrate.php
  - [ ] Uploaded to backend/
  - [ ] Accessed: https://jerzy.lk/oceanlilly/backend/migrate.php
  - [ ] Clicked "Run Migrations"
  - [ ] Status: ☐ Success ☐ Failed

### STEP 9: Verify Database Tables
- [ ] Accessed phpMyAdmin
- [ ] Selected database: _______________
- [ ] Verified all 16 tables exist:
  - [ ] packages
  - [ ] categories_tour
  - [ ] blog_posts
  - [ ] categories_blog
  - [ ] gallery_images
  - [ ] testimonials
  - [ ] tripadvisor_reviews
  - [ ] hero_slides
  - [ ] inquiries
  - [ ] bookings
  - [ ] services
  - [ ] why_choose_us
  - [ ] about_us
  - [ ] footer_content
  - [ ] navbar_items
  - [ ] partners
  - [ ] seo_pages
  - [ ] settings
  - [ ] admin_users
  - [ ] admin_audit_log

- [ ] Checked table structure (spot-check 3-4 tables)
  - Tables checked:
    1. _______________
    2. _______________
    3. _______________
    4. _______________

- [ ] Verified indexes exist on each table

### STEP 10: Insert Admin User
- [ ] Created admin user in phpMyAdmin
  - Email: admin@oceanlilly.com
  - Name: Admin User
  - Role: admin
  - Active: 1
  - Password: [hashed] ✓
  
- [ ] Verified admin user in database
  - Admin email: admin@oceanlilly.com
  - Status: ☐ Found ☐ Not Found

### STEP 11: Insert Default Settings
- [ ] Inserted default settings:
  - [ ] site_name
  - [ ] site_description
  - [ ] site_email
  - [ ] site_phone
  - [ ] smtp_host
  - [ ] smtp_port
  - [ ] smtp_username
  - [ ] maintenance_mode
  - [ ] cache_enabled

### STEP 12: Insert Sample Packages
- [ ] Inserted 8 sample packages
- [ ] Verified packages in database:
  - [ ] Misty Mountain Adventure
  - [ ] Beach Paradise Escape
  - [ ] Cultural Heritage Tour
  - [ ] Wildlife Safari Adventure
  - [ ] Tea Plantation Tour
  - [ ] Whale Watching Expedition
  - [ ] Waterfall Trek
  - [ ] Local Village Experience

### STEP 13-15: Upload Models, Controllers & Middleware
- [ ] Created models/ folder
- [ ] Created controllers/ folder
- [ ] Uploaded 20 Model files
- [ ] Uploaded 21 Controller files
- [ ] Uploaded 3 Middleware files

### STEP 16: Upload Routes Files
- [ ] Created routes/ folder
- [ ] Uploaded routes/api.php
- [ ] Uploaded routes/admin-api.php

### STEP 17: Test Database Connection
- [ ] Downloaded test-connection.php
- [ ] Uploaded to backend/test-connection.php
- [ ] Accessed: https://jerzy.lk/oceanlilly/backend/test-connection.php
- [ ] Test results:
  - [ ] ✅ Database Connection: SUCCESS
  - [ ] ✅ Admin User Found
  - [ ] ✅ Packages Count: 8
  - [ ] ✅ All Tables Count: 18

### STEP 18: Verify Public API
- [ ] Created public/index.php
- [ ] Accessed: https://jerzy.lk/oceanlilly/backend/public/api/test
- [ ] Response: "API is working"

### STEP 19: Setup .htaccess
- [ ] Downloaded .htaccess
- [ ] Uploaded to backend/.htaccess
- [ ] Verified URL rewriting works

### STEP 20: Final Verification & Safety Checkup

#### Database Health
- [ ] All 16 tables exist ✓
- [ ] admin_users has 1 admin ✓
- [ ] packages has 8 samples ✓
- [ ] settings has defaults ✓
- [ ] Foreign keys working ✓
- [ ] Indexes present ✓

#### File Structure
- [ ] backend/ folder exists ✓
- [ ] All subdirectories created ✓
- [ ] All migration files present ✓
- [ ] .env file configured ✓
- [ ] public/index.php present ✓

#### Permissions
- [ ] uploads/ → 755 ✓
- [ ] storage/ → 777 ✓
- [ ] .env → 644 (not readable) ✓

#### Security
- [ ] Admin password hashed ✓
- [ ] Database password strong ✓
- [ ] .env not in public folder ✓
- [ ] API routes protected ✓

#### API Testing
- [ ] GET /api/packages → Works ✓
- [ ] Authentication endpoints exist ✓
- [ ] File upload configured ✓

---

## 📊 SUMMARY

### Statistics Collected
- Database name: _______________
- Admin user: _______________
- Total tables: 18
- Total migrations: 20
- Sample packages: 8
- Setup time: ___________ minutes

### Credentials Saved
- [ ] Database credentials saved securely
- [ ] Admin credentials saved securely
- [ ] SMTP credentials saved securely
- [ ] Backup files saved

### Next Phase
- [ ] Phase 0 complete ✅
- [ ] Ready for Phase 1: Core Features
- [ ] Sent completion email

---

## ✅ FINAL SIGN-OFF

**Phase 0 Status:**
- [ ] All steps completed
- [ ] All tests passed
- [ ] Database verified
- [ ] Security checked
- [ ] Ready to proceed

**Completed by:** _________________________  
**Date:** _____/_____/________  
**Time taken:** ___________ hours  
**Issues encountered:** ___________________  
**Resolution:** ___________________________  

**Sign-off:** ✅ PHASE 0 COMPLETE - READY FOR PHASE 1!

---

## 💬 SUPPORT

If any step fails:
1. Note the error message
2. Check PHASE_0_CPANEL_MANUAL_SETUP.md → Troubleshooting
3. Email support with:
   - Step number
   - Error message
   - Screenshot if possible
   - Your database name (without password)

**Email support with:** "Phase 0 - Step [X] - [Error]"

---

**🎉 Congratulations! Your database foundation is complete!**

Next: I will create **Phase 1** (Models, Controllers, API Endpoints)

