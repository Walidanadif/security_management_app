## 📂 Security-App - Gestion Agents Sécurité (Laravel 12)

**App complète de pointage/gestion agents sécurité** : plannings, présences (présent/absent/retard/congé), dashboards admin/agent, calendriers.

### 🏗️ Structure Projet
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

### 🚀 Installation Rapide + Seeders
```
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm run dev
php artisan serve
```

### 🎮 Comptes Démo **(MDP : `test@1234` pour tous)**
**Admin :**
- `admin@security-app.com` → Dashboard complet + 16 agents

**Agents (16) :** Tous visibles dans listes/présences !
```
ahmed@test.com (Ahmed Benali)
fatima@test.com (Fatima Zahra)  
mohamed@test.com (Mohamed Ali)
aisha@test.com (Aisha Khalid)
omar@test.com (Omar Hassan)
sara@test.com (Sara Ben)
youssef@test.com (Youssef El)
leila@test.com (Leila Amira)
karim@test.com (Karim Said)
nadia@test.com (Nadia Rached)
hassan@test.com (Hassan Morad)
mariam@test.com (Mariam El)
rachid@test.com (Rachid Ben)
soumia@test.com (Soumia Ali)
walid@test.com (Walid Karim)
imane@test.com (Imane Said)
```

### 🧪 Fonctionnalités 100% OK
- ✅ **Dashboard admin** : 16 agents + graphiques **répartition présences aujourd'hui**
- ✅ **Liste présences admin** : **16 agents** (status variés)
- ✅ **Agent login** : pointage/calendrier/historique personnel
- ✅ CRUD sites/plannings
- ✅ **Absences auto** : `php artisan schedule:work`

**Live :** http://127.0.0.1:8000 (ou 8001)

### 📊 Stack
- Backend : **Laravel 12** | Eloquent | SQLite (auto)
- Frontend : **Tailwind** | **Alpine.js** | **Vite** | Charts.js
- Auth : Role middleware

**🚀 Production Ready** : Seeders + démos = parfait !
