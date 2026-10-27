# Student Accommodation - Backend Setup Guide

Backend PHP + MySQL me banaya gaya hai. Isko chalane ke liye **XAMPP** (ya WAMP) chahiye.

## Step 1: XAMPP Install karo
1. https://www.apachefriends.org se XAMPP download karo (agar pehle se nahi hai)
2. Install karke **Apache** aur **MySQL** dono start kar do (XAMPP Control Panel se)

## Step 2: Project ko htdocs me copy karo
1. Poora `student_Accommodation` folder copy karke XAMPP ke `htdocs` folder me paste kar do
   - Windows: `C:\xampp\htdocs\student_Accommodation`
   - Mac: `/Applications/XAMPP/htdocs/student_Accommodation`

## Step 3: Database banao
1. Browser me kholo: `http://localhost/phpmyadmin`
2. Left side me "New" click karo, database ka naam type mat karo (SQL file khud database bana dega)
3. "Import" tab pe jao, aur `backend/database.sql` file select karke import kar do
   - Ye khud `student_accommodation` database bana dega with sample properties

## Step 4: DB credentials check karo
`backend/config/db.php` file kholo aur check karo:
```php
$username = "root";
$password = "";
```
Default XAMPP me ye sahi hote hain. Agar tumne password set kiya hai MySQL me, to yahan update kar dena.

## Step 5: Website kholo
Browser me jao: `http://localhost/student_Accommodation/index.php`

## Backend API Endpoints
| Endpoint | Method | Kaam |
|---|---|---|
| `backend/api/register.php` | POST | New user signup |
| `backend/api/login.php` | POST | User login (session start) |
| `backend/api/logout.php` | POST | Logout (API version) |
| `backend/api/properties.php` | GET | Saari properties (ya `?location=city` se filter) |
| `backend/api/property.php?id=1` | GET | Ek property ki details |
| `backend/api/reviews.php?property_id=1` | GET | Ek property ki reviews |
| `backend/api/book.php` | POST | Property book karna (login required) |
| `backend/api/contact.php` | POST | Contact form submit |

## Navbar Ek Jagah Se Manage Hota Hai
`index.php`, `about-us.php`, `properties.php`, `property-detail.php` — in char pages ka navbar ab `navbar.php` file se aata hai (PHP `include` ke through). Navbar me kuch change karna ho (link add/remove, naam badalna) to sirf `navbar.php` edit karo, sab 4 pages khud update ho jayenge. Login karne ke baad navbar me "Hi, Naam" + Logout dikhega; `logout.php` session clear karke home page pe bhej dega.

`login.html`, `signup.html`, `contact-us.html` abhi bhi plain `.html` hi hain kyunki inka navbar structure/design baaki pages se alag tha, isliye inhe chheda nahi taaki unka look same rahe.

## Ye Sab Fix/Add Kiya Gaya
- Home page ka **Search box** aur **city cards** ab `properties.php?location=City` pe le jaate hain (pehle kuch nahi hota tha)
- Home page ki **Featured Properties** ab database se aati hain (pehle fake/hardcoded thi)
- Property detail page ki **Amenities**, **Rating**, **Reviews**, aur **Similar Properties** — sab ab us specific property ke hisaab se dynamic hain (pehle sab properties pe same content dikhta tha)
- Footer ke broken links (`about.html`, `contact.html`) fix kiye — ab sahi `about-us.php` / `contact-us.html` pe jaate hain

## ⚠️ Zaroori: Database Dobara Update Karo
Is update me ek naya **`reviews`** table add hua hai. Agar tumne pehle `database.sql` import kiya tha, to us database me ye table nahi hoga. Fix karne ke liye:
1. phpMyAdmin me apna database kholo (jaise `student_accommodation`)
2. **Import** tab pe jao, naya `backend/database.sql` file choose karo, Import dabao
3. `CREATE TABLE IF NOT EXISTS` hone ki wajah se purane tables/data ko kuch nahi hoga — bas naya `reviews` table aur uska sample data add ho jayega

## Naye Properties Add Karne Ke Liye
phpMyAdmin me `properties` table me naya row add karo, aur `property_amenities` table me uski amenities add karo. Wo automatically properties.php pe show ho jayengi.

## Notes
- Passwords `password_hash()` se securely store hote hain
- Login session-based hai (PHP sessions)
- Agar CORS error aaye, to backend aur frontend same domain (localhost) pe hi rakho
