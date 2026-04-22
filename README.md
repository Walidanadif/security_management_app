## 🔒 **Security Management App** - Système de Gestion des Agents de Sécurité (Laravel 12)

[![Laravel](https://img.shields.io/badge/Laravel-12-brightgreen?style=flat-square&logo=laravel)](https://laravel.com) [![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.4-blue?style=flat-square&logo=tailwindcss)](https://tailwindcss.com) [![Vite](https://img.shields.io/badge/Vite-5.0-orange?style=flat-square&logo=vite)](https://vitejs.dev) [![SQLite](https://img.shields.io/badge/SQLite-Auto%20Setup-green?style=flat-square&logo=sqlite)](https://sqlite.org)

### 📋 **Description Professionnelle**

**Security Management App** est une solution complète **Full-Stack** de gestion et de pointage des agents de sécurité développée avec **Laravel 12**, **TailwindCSS**, **Vite** et **Charts.js**.

**Fonctionnalités principales :**
- **Gestion complète des agents** (CRUD + détails: nom, téléphone, adresse)
- **Pointage intelligent** (présent/absent/retard/congé avec graphiques)
- **Plannings avancés** (agent ↔ site ↔ dates/horaires)
- **Dashboards responsives** (Admin: 16 agents + stats | Agent: personnel)
- **Sécurité renforcée** (Auth Breeze + middleware roles admin/agent)
- **Setup 30 secondes** (DB SQLite auto-créée)

**Production Ready** - Déploiement Heroku/Vercel Nixpacks en 1 clic.

### 🚀 **Installation Express (30s - DB 100% Auto)**

```bash
git clone https://github.com/Walidanadif/security_management_app.git
cd security_management_app
composer install && npm install
cp .env.example .env && php artisan key:generate
php artisan migrate          # ← DB SQLite AUTO-CRÉÉE !
npm run dev                  # ← Tailwind/Vite HMR
php artisan serve            # ← http://127.0.0.1:8000
```

**One-liner démo complète :**
```bash
php artisan migrate:fresh --seed  # 16 agents + données en 2s !
```

### 🎮 **Comptes Démo Prêts (Password: `test@1234`)**

| **Role** | **Email**                    | **Accès** |
|----------|------------------------------|-----------|
| 👑 Admin | `admin@security-app.com`     | Full dashboard + 16 agents |
| 👥 Agent 1 | `ahmed@test.com`           | Dashboard personnel |
| 👥 Agent 2 | `fatima@test.com`           | Pointage personnel |
| ... + **14 autres agents** | `*test.com` | Listes complètes |

### 🏗️ **Architecture Technique**

```
📁 security-app/ (Laravel 12 + Modern Stack)
├── 🎛️ Controllers : Agent/Dashboard/Planning/Presence/Site/Auth
├── 🗄️ Models : User(role)|Agent|Site|Planning|Presence|Conge
├── 🎨 Views : Dashboard(admin/agent)|CRUD|Calendriers|Auth
├── 🗃️ DB : Migrations + Seeders(16 agents auto)
├── 🛡️ Middleware : Admin protection
└── 🚀 Deployment : Nixpacks.toml Heroku ready
```

### 📊 **Stack Technologique Premium**
```
Backend : Laravel 12 | Eloquent ORM | SQLite Auto
Frontend : TailwindCSS 3.4 | Alpine.js | Vite 5 | Charts.js
Auth : Laravel Breeze + Role Middleware
Deployment : Nixpacks | Heroku | Vercel | Forge
```

### ✅ **Fonctionnalités Testées & Production Ready**

| **Feature** | **Status** | **Détails** |
|-------------|------------|-------------|
| Dashboard Admin | ✅ | 16 agents + graphiques temps réel |
| Pointage Agent | ✅ | Présent/Absent/Retard/Con gé |
| CRUD Sites/Plannings | ✅ | Full responsive |
| Listes Présences | ✅ | Admin voit tous 16 agents |
| Absences Auto | ✅ | `php artisan schedule:work` |

### 🌐 **Live Demo Local**
```
http://127.0.0.1:8000
Admin → Dashboard → 16 agents visibles instantanément
```

**[GitHub Repository](https://github.com/Walidanadif/security_management_app)** | **Laravel 12** | **Production Ready** | **LinkedIn Portfolio Perfect**

---

**👨‍💻 Développé par Walid - Full-Stack Laravel Developer**

