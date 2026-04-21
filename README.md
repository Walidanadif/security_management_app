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

### 🚀 Installation Rapide
```
git clone https://github.com/Walidanadif/security_management_app.git
cd security-app
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
```

**DB .env :**
```
DB_DATABASE=security_management_app
DB_USERNAME=laravel
DB_PASSWORD=Laravel@123
```

### 🎮 Comptes Démo (MDP : `test@1234`)
- **Admin** : `admin@security-app.com`
- **Agents** : `ahmed@test.com`, `fatima@test.com`

**Live :** http://127.0.0.1:8001

### 🧪 Fonctionnalités
- Dashboard admin → agents/sites/plannings/présences
- Agent → pointage/calendrier/historique
- CRUD sites/plannings
- Absences auto : `php artisan schedule:work`

### 📊 Stack
- Backend : Laravel 12, Eloquent, MySQL
- Frontend : Blade, Tailwind CSS, Alpine.js, Vite
- Auth : Role middleware

**Ready for production !** Logs confirment navigation parfaite.
