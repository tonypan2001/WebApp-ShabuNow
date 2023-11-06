# โปรเจคนี้เกี่ยวกับอะไร ?
>เป็นเว็บไซต์สำหรับร้านอาหารที่ช่วยอำนวยความสะดวกในการบริหารจัดการร้านอาหารที่มีฟังก์ชั่นเช่น จองโต๊ะลูกค้า,เพิ่มเมนู,เพิ่มเจ้าหน้าที่ที่เกี่ยวข้อง รวมถึงระบบในการสั่งซื้อของลูกค้า เป็นต้น
# ชื่อสมาชิกในกลุ่ม



> นายธเนศ จีนสีคง 6410451067 หมู่ 200

> ธนดล มหาพรรณ 6410450982 หมู่ 200

> สุศิษฐิ์ ต๊ะมามูล 6410451504 หมู่ 200

> พร้อมพันธุ์ เอื้อชาญเวช 6410451172 หมู่ 200

> ภาธร ยังละออ 6410451296 หมู่200

> ธนดล มหาพรรณ 6410450982 หมู่ 200

> จิรกิตต์ ชนะกลาง 6410450095 หมู่ 200


# วิธีการติดตั้ง Laravel Project **ShabuNow** (Backend)

>เข้าไปใน file ShabuNow ด้วยคำสั่ง cd ShabuNow จากนั้นรันคำสั่งดังนี้
>
>run คำสั่งใน bash

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

> run คำสั่งใน bash

```bash
cp .env.example .env
```

> เข้าไปใน file (.env) ของ project

```
APP_NAME="Laravel Layout"
DB_HOST=mysql
DB_USERNAME=sail
DB_PASSWORD=password
REDIS_HOST=redis
```

> run คำสั่งใน bash

```bash
sail up -d
```

> run คำสั่งใน bash

```bash
sail artisan key:generate
```

> run คำสั่งใน bash

```bash
sail yarn install
```

> run คำสั่งใน bash

```bash
sail artisan storage:link
```

> run คำสั่งใน bash

```bash
sail yarn dev
```

> รัน seeder และสร้าง table ใหม่

```bash
sail artisan migrate:fresh --seed
```

### role ในการใช้งาน

---

> ### Customer 
>
> -   username: Customer@example.com
> -   password: password

---

> ### Staff
>
> -   username: Staff@example.com
> -   password: password

---
> ### Admin
>
> -   username: Admin@example.com
> -   password: password
---

> ### Chef
>
> -   username: Chef@example.com
> -   password: password
