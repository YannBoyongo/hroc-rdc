# NGO Website – Laravel + Tailwind CSS

## 📌 Project Overview
This project is a **multi-page NGO website** built with **Laravel** and **Tailwind CSS**.  
It is designed to be **professional, credible, scalable, and production-ready**, suitable for NGOs communicating with donors, partners, and beneficiaries.

The website follows a clean structure, strong accessibility standards, and a humanitarian visual identity.

---

## 🛠️ Tech Stack
- **Laravel** (Blade templating)
- **Tailwind CSS** (custom color palette)
- **Alpine.js** (light interactivity such as carousel & dropdowns)


---

## 🎨 Design & Branding
- Uses the **Tailwind color palette defined in the project**
- Logo loaded from: `public/images`
- Favicon loaded from: `public/images`
- Consistent typography, spacing, and contrast
- Responsive (desktop, tablet, mobile)

##colors
{ 'deep_twilight': { DEFAULT: '#03045e', 100: '#010113', 200: '#010226', 300: '#020338', 400: '#02044b', 500: '#03045e', 600: '#0508ae', 700: '#0f12f8', 800: '#5f61fa', 900: '#afb0fd' }, 'french_blue': { DEFAULT: '#023e8a', 100: '#000c1b', 200: '#011836', 300: '#012451', 400: '#02306d', 500: '#023e8a', 600: '#035cd1', 700: '#2381fc', 800: '#6cabfd', 900: '#b6d5fe' }, 'bright_teal_blue': { DEFAULT: '#0077b6', 100: '#001825', 200: '#003049', 300: '#00486e', 400: '#005f93', 500: '#0077b6', 600: '#00a2f9', 700: '#3bbaff', 800: '#7cd1ff', 900: '#bee8ff' }, 'blue_green': { DEFAULT: '#0096c7', 100: '#001e28', 200: '#003c50', 300: '#005a77', 400: '#00779f', 500: '#0096c7', 600: '#06c1ff', 700: '#44d0ff', 800: '#83e0ff', 900: '#c1efff' }, 'turquoise_surf': { DEFAULT: '#00b4d8', 100: '#00242b', 200: '#004756', 300: '#006b81', 400: '#008fab', 500: '#00b4d8', 600: '#12d8ff', 700: '#4ee1ff', 800: '#89ebff', 900: '#c4f5ff' }, 'sky_aqua': { DEFAULT: '#48cae4', 100: '#082d34', 200: '#105a69', 300: '#17879d', 400: '#1fb4d1', 500: '#48cae4', 600: '#6dd5e9', 700: '#92dfef', 800: '#b6eaf4', 900: '#dbf4fa' }, 'frosted_blue': { DEFAULT: '#90e0ef', 100: '#0a3a43', 200: '#137586', 300: '#1dafc9', 400: '#4ccfe6', 500: '#90e0ef', 600: '#a6e7f2', 700: '#bcedf5', 800: '#d2f3f9', 900: '#e9f9fc' }, 'frosted_blue': { DEFAULT: '#ade8f4', 100: '#0a3f4a', 200: '#147e93', 300: '#1ebddd', 400: '#65d4ea', 500: '#ade8f4', 600: '#beedf6', 700: '#cff1f8', 800: '#dff6fb', 900: '#effafd' }, 'light_cyan': { DEFAULT: '#caf0f8', 100: '#0a444f', 200: '#15889f', 300: '#2ac4e3', 400: '#79daee', 500: '#caf0f8', 600: '#d4f3f9', 700: '#dff6fb', 800: '#e9f9fc', 900: '#f4fcfe' } }

---

## 🧭 Site Structure & Navigation

### Main Menu

#### **À propos**
- Qui sommes-nous ?
- Notre mission
- Notre vision
- Nos objectifs

#### **Nos actions**
- Domaines d’intervention
- Nos approches
- Nos réalisations

#### **Contact**
- Contact page (form + NGO details)

Menus use **dropdown sub-menus** where necessary.

---

## 🏠 Home Page
- **No hero section**
- Top section contains a **carousel slider with exactly 3 images**
  - Images loaded from `public/images`
  - Auto-play with navigation controls
- Below the carousel:
  - Short NGO introduction
  - Key domains of intervention
  - Impact highlights (numbers or short statements)

---

## 📄 Pages Description

### Qui sommes-nous ?
- NGO identity, background, values, and legal context

### Notre mission
- Clear, short, action-oriented mission statement

### Notre vision
- Long-term impact and societal change

### Nos objectifs
- Structured, measurable objectives

### Domaines d’intervention
- Presented as cards with icons and brief descriptions

### Nos approches
- Methodologies (participatory, inclusive, sustainable, results-based)

### Nos réalisations
- Achievements, impact statistics, success stories, photos

### Contact
- Contact form:
  - Name
  - Email
  - Subject
  - Message
- Laravel validation & email sending
- NGO address, phone, email, social media links

---

## 🧱 Code Architecture

```
resources/views/
│── layouts/
│   ├── app.blade.php
│
│── components/
│   ├── navbar.blade.php
│   ├── footer.blade.php
│   ├── carousel.blade.php
│
│── pages/
│   ├── home.blade.php
│   ├── about/
│   ├── actions/
│   ├── contact.blade.php
```

- Reusable Blade components
- Clean routes & controllers
- SEO-friendly semantic HTML

---

## ✉️ Contact Form
- Server-side validation
- Email sending via Laravel Mail
- Ready for SMTP or third-party mail services

---

## 🚀 Deployment Ready
This project is:
- Production-ready
- SEO-optimized
- Accessible
- Easy to extend (CMS, blog, donation module, etc.)

---

## 📝 Customization Checklist
Update the following for your NGO:
- [ ] Logo in `public/images`
- [ ] Favicon in `public/images`
- [ ] Tailwind color palette
- [ ] NGO texts and statistics
- [ ] Contact details & email configuration

---

## 📄 Language
French only.

##About the NGO
Name: "Healing and Rebuilding Our Communities" do not translate this in french
Short form: HROC RDC
About us: We work in the areas of peacebuilding, the promotion of human rights, leadership and good governance, community resilience and engagement, as well as the empowerment of active agents of change and vulnerable populations (youth, women, ex-combatants, refugees and internally displaced persons, and children), with the aim of contributing to peace reconstruction and sustainable development in the Democratic Republic of Congo.
