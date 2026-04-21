## 📂 Security-App - Gestion Agents Sécurité **(Laravel 12)** 🚀

[![Laravel 12](https://img.shields.io/badge/Laravel-12-green.svg)](https://laravel.com) [![TailwindCSS](https://img.shields.io/badge/Tailwind-CSS-blue.svg)](https://tailwindcss.com) [![Vite](https://img.shields.io/badge/Vite-Fast-orange.svg)](https://vitejs.dev)

**App complète pointage/gestion 16 agents sécurité** : plannings, présences (présent/absent/retard/congé), dashboards admin/agent, calendriers, graphiques.

### 🚀 **Installation 30s (DB 100% AUTO)**

**Numérotée exacte :**
1. `git clone https://github.com/Walidanadif/security_management_app.git`
2. `cd security_management_app`  
3. `composer install`
4. `npm install`
5. `cp .env.example .env`
6. `php artisan key:generate`
7. **`php artisan migrate`** ← **DB SQLite AUTO-CRÉÉE** ! (database/database.sqlite)
8. `npm run dev` ← Tailwind/Vite
9. `php artisan serve` ← **http://127.0.0.1:8000**

**🔥 One-liner démo complète :**
```
php artisan migrate:fresh --seed  # DB + 16 agents en 2s !
```

### 🏗️ **Structure Projet**
```
security-app/ (Laravel 12 + Tailwind + Vite)
├── app/
│   ├── Http/Controllers/
│   │   ├── AgentController.php      # CRUD agents + pointage
│   │   ├── DashboardController.php  # Dashboards admin/agent
│   │   ├── PlanningController.php   # Gestion plannings
│   │   ├── PresenceController.php   # Pointage présences
│   │   ├── SiteController.php       # CRUD sites
│   │   └── Auth/*                   # Login/register
│   ├── Models/
│   │   ├── Agent.php (user_id FK)   # Agents sécurité
│   │   ├── Planning.php (agent/site) # Affectations
│   │   ├── Presence.php             # Pointages (present/absent/retard/conge)
│   │   ├── Site.php                 # Sites missions
│   │   ├── User.php (role admin/agent)
│   │   └── Conge.php                # Demandes congés
│   └── Middleware/AdminMiddleware.php
├── database/migrations/
│   ├── users + role
│   ├── agents (nom/tel/adresse/user_id)
│   ├── sites (nom/adresse)
│   ├── plannings (agent_id/site_id/date/horaires)
│   ├── presences (agent_id/date/statut)
│   └── conges (agent_id/dates/statut)
├── resources/views/
│   ├── dashboard/ (admin/agent)
│   ├── agents/ (list/calendrier/pointage/create)
│   ├── sites/ (CRUD)
│   ├── plannings/ (CRUD)
│   ├── admin/presence/
│   └── auth/ (login/register)
├── routes/web.php
├── public/build/assets/ (Vite/Tailwind)
└── storage/ (logs/cache)
```

### 🎮 **16+ Comptes Démo (MDP : `test@1234`)**

**👑 ADMIN :**
- `admin@security-app.com` → Dashboard + 16 agents + graphiques

**👥 AGENTS (16) - Tous visibles listes/présences :**
```
1. ahmed@test.com     (Ahmed Benali)
2. fatima@test.com    (Fatima Zahra)  
3. mohamed@test.com   (Mohamed Ali)
4. aisha@test.com     (Aisha Khalid)
5. omar@test.com      (Omar Hassan)
6. sara@test.com      (Sara Ben)
7. youssef@test.com   (Youssef El)
8. leila@test.com     (Leila Amira)
9. karim@test.com     (Karim Said)
10. nadia@test.com    (Nadia Rached)
11. hassan@test.com   (Hassan Morad)
12. mariam@test.com   (Mariam El)
13. rachid@test.com   (Rachid Ben)
14. soumia@test.com   (Soumia Ali)
15. walid@test.com    (Walid Karim)
16. imane@test.com    (Imane Said)
```

### ✅ **Fonctionnalités Testées**
| Feature | Status |
|---------|--------|
| Dashboard admin 16 agents + **graphiques** | ✅ |
| Liste présences admin (16 agents) | ✅ |
| Pointage agent personnel | ✅ |
| CRUD sites/plannings | ✅ |
| Absences auto | `schedule:work` ✅ |

### 📊 **Stack Moderne**
```
Backend: Laravel 12 | Eloquent | SQLite auto
Frontend: TailwindCSS | Alpine.js | Vite | Charts.js
Auth: Breeze + Role middleware
Deployment: 1-click Heroku/Vercel ready
```

**Live Demo :** http://127.0.0.1:8000 | **[GitHub](https://github.com/Walidanadif/security_management_app)**

**🎯 Production Ready - LinkedIn Portfolio parfait !**

