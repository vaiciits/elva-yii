# Elva homework

## Task

Uzdevums: darbu pārvaldības modulis
Nosacījumi:

- Drīkst izmantot jebkādus gatavus pieejamus resursus un bibliotēkas
- Risinājumam jābūt balstītam uz Yii framework un kā datubāze jāizmanto MS SQL.
- Jāiesniedz pieeja risinājuma repozitorijam, kur papildus kodam mapē ‘SQL” jābūt
  izveidotiem nepieciešamajiem SQL skriptiem.
- Papildus uzdevuma prasībām drīkst veidot datu modeļus un struktūras
  funkcionalitātes nodrošināšanai
- Prasības, kas nav definētas, realizēt atbilstoši biznesa procesa izpratnei

Tiks vērtēts:

- Koda kvalitāte un atkārtotas izmantošanas iespējas.
- Funkcionālo prasību nodrošināšana.
- Uzdevuma izpildes ātrums

Uzdevums

1. Izveidot SQL tabulu EMPLOYEE, kurā glabāt darbinieku, tā vārdu uzvārdu, dzimšanas
   dienu, pieejas līmeni, lomu, aizpildīt ar vismaz trīs ierakstiem.
2. Izveidot Tabulu CONSTRUCTION_SITE kurā glabāt Būvobjektus, to atrašanās vietu,
   kvadratūru, nepieciešamo pieejas līmeni, aizpildīt ar vismaz trīs būvobjektiem.
3. Izveidot tabulu WORK_ITEM kurā glabāt iespējamo darbu sarakstu. Aizpildīt ar vismaz
   trīs iespējamiem darbiem.
4. Izveidot 3 līmeņu lomas: admin, manager, employee
5. Izveidot funkcionalitāti:
   1. admin ir tiesīgs redzēt, pievienot, rediģēt, dzēst darbiniekus, būvobjektus un
      darbus.
   2. manager ir tiesīgs izveidot darbu sarakstu pakļautajiem darbiniekiem, norādot
      darbu un būvobjektu noteiktam darbiniekam, atbilstoši piekļuves līmenim.
   3. employee ir tiesīgs redzēt sev piešķirto darbu sarakstu un kurā būvobjekta,
      kādi darbi ir jāveic.
6. Izveidot API, kur ārēja caurlaižu sistēma var pieprasīt informāciju par Būvobjektu, lai
   uzzinātu kuriem darbiniekiem ir nepieciešama pieeja noteiktam būvobjektam, darbu
   izpildei.

## Setup

Setup docker. Don't worry for configurator for failing.

```bash
docker-compose up -d
```

After yii backend container is ready,

```bash
docker exec -it elva-yii-backend-1 bash
```

Run data seeders (inside the container)

```bash
yii seed
```
