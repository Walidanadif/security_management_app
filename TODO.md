# TODO - Mise à jour README.md

**✅ Étapes confirmées par user :**
1. git clone https://github.com/Walidanadif/security_management_app.git
2. cd security_management_app  
3. composer install
4. npm install
5. cp .env.example .env
6. php artisan key:generate
7. **php artisan migrate** ← DB SQLite **AUTO-CRÉÉE** !
8. npm run dev ← Tailwind/Vite
9. php artisan serve ← http://127.0.0.1:8000

**Plan update README :**
- Remplacer installation par **étapes numérotées 1-9** 
- Ajouter **"DB 100% AUTO"** en gras
- **One-liner** : `php artisan migrate:fresh --seed`
- Badges GitHub/Live Demo

**Prochaine étape :** Edit README.md → git push main
