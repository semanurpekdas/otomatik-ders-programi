@extends('layout')

@section('title', 'Ders Programı')

@section('content')

    <div class="px-5 my-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center bg-dark rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Ders Programı</h2>
                </div>
            </div>
            <div class="d-flex justify-content-between my-4"> 
                <div>
                    <a href="{{ route('akademisyenler.gun') }}" class="btn btn-warning text-white warning-active-overlay">Akademisyen Gün Ayarları</a>
                    <a href="{{ route('dersprogrami') }}" class="btn btn-dark text-white dark-active-overlay">Ders Programı Ayarları</a>
                </div>
                <div>
                    <button id="programolusturbutton" class="btn btn-primary text-white primary-active-overlay">Yeni Ders Programı Oluştur</button>
                </div>
            </div>
            <div>
                <h5 class="h4 text-center">Ders Programı</h5>
                <!-- Alert Mesajları -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center mt-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show text-center mt-3" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div id="loadingSpinner" class="spinner-border text-primary" role="status" style="display: none;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="mt-3 px-5 py-3 border" id="dersprogramıcontainer">
                <div class="alert alert-primary text-center alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-square-fill me-2"></i>
                    <b>Ders programınız bulunmamaktadır. Oluşturmak için aşağıdaki buttona tıklayınız.</b>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                </div>
            </div>
        </div>
    </div>
    


    <style>
        #sınıftab {
            margin-top: -80px; /* Yukarıya çekmek için negatif margin */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        table {
            font-size: 1.2rem;
        } 

        form i{
            font-size: 1.2rem;
        }

        form .mb-3{
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: all 0.2s ease-in-out;
        }

        form .mb-3:hover{
            border: 1px solid  #034f84;
            border-radius: 10px;
            border-left: 7px solid #034f84;
        }

        .form-control {
            font-size: 1.2rem;
            border: none;
            outline: none;
            box-shadow: none;
            letter-spacing: 0.1rem;
        }

        .form-control:focus {
            outline: none;
            box-shadow: none;
        }

        .form-select {
            font-size:  1.1rem;
            border: none;
            outline: none;
            box-shadow: none;
            letter-spacing: 0.1rem;
        }

        .form-select:focus {
            outline: none;
            box-shadow: none;
        }

        /* Checkbox*/
        .custom-checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .custom-checkbox {
            position: relative;
            margin-right: 15px;
        }

        .custom-checkbox input[type="checkbox"] {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }

        .custom-checkbox label {
            position: relative;
            display: inline-flex;
            align-items: center;
            padding-left: 35px;
            font-size: 15px;
            cursor: pointer;
            color: #333;
            user-select: none;
            transition: all 0.3s ease;
        }

        .custom-checkbox label::before {
            content: '';
            position: absolute;
            left: 0;
            width: 20px;
            height: 20px;
            border: 2px solid #aaa;
            border-radius: 4px;
            background-color: transparent;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .custom-checkbox input[type="checkbox"]:checked + label::before {
            background-color: #6c63ff;
            border-color: #6c63ff;
        }

        .custom-checkbox label::after {
            content: '✓';
            position: absolute;
            top: -1px;
            left: 4px;
            font-size: 18px;
            color: #fff;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .custom-checkbox input[type="checkbox"]:checked + label::after {
            opacity: 1;
        }

        .custom-checkbox label:hover::before {
            border-color: #6c63ff;
        }

    </style>

    
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const button = document.getElementById("programolusturbutton");
            const container = document.getElementById("dersprogramıcontainer");

            if (!button || !container) {
                console.error("Button or container not found!");
                return;
            }

            // Haftanın günleri ve saat bilgileri
            const gunlukDersSaati = @json($gunlukDersSaati);
            let gunler = @json($gunler);
            
            // Dersler, Akademisyen Günleri, Salonlar (örnek veriler)
            let dersler = @json($dersler);
            const akademisyenGunleri = @json($akademisyenGunleri);
            let salonlar = @json($salonlar);
            let dersProgramiSartlari = @json($dersProgramiSartlari);
            console.log("Dersler:", dersler);
            console.log("dersProgramiSartlari:", dersProgramiSartlari);

            // JSON Parse işlemi gereken alanlar
            dersler = dersler.map(ders => {
                return {
                    ...ders,
                    sinif: ders.sinif,
                    sinif_id: JSON.parse(ders.sinif_id || "[]"),
                    ders_sinif: JSON.parse(ders.ders_sinif || "[]"),
                };
            });

            button.addEventListener("click", function () {
                console.log("Ders programı oluşturuluyor...");

                // Sınıflara göre dersler gruplandırılıyor
                const siniflar = {};
                dersler.forEach(ders => {
                    if (!siniflar[ders.sinif]) siniflar[ders.sinif] = [];
                    siniflar[ders.sinif].push(ders);
                });

                // Her sınıf için program oluşturuluyor
                const programTablolari = Object.keys(siniflar).map(sinif => {
                    return {
                        sinif,
                        tablo: createProgramTable(
                            siniflar[sinif],
                            akademisyenGunleri,
                            salonlar,
                            gunler,
                            gunlukDersSaati,
                            dersProgramiSartlari
                        )
                    };
                });

                // Program HTML olarak yazdırılıyor
                renderProgram(container, programTablolari);
            });

            function createProgramTable(dersler, akademisyenGunleri, salonlar, gunler, gunlukDersSaati, dersProgramiSartlari) {
                const tablo = {};
                gunler.forEach(gun => {
                    tablo[gun] = Array(gunlukDersSaati).fill(null);
                });

                const salonKullanim = gunler.reduce((acc, gun) => {
                    acc[gun] = {};
                    salonlar.forEach(salon => {
                        acc[gun][salon.isim] = Array(gunlukDersSaati).fill(false);
                    });
                    return acc;
                }, {});

                // 1. Dersleri Parçala
                const parcaliDersler = [];
                dersler.forEach(ders => {
                    let kalanSaat = ders.ders_sayisi;
                    const parcalar = Array(ders.ders_parcasi).fill(Math.floor(kalanSaat / ders.ders_parcasi));
                    for (let i = 0; i < kalanSaat % ders.ders_parcasi; i++) {
                        parcalar[i] += 1;
                    }
                    parcalar.forEach((sure, index) => {
                        parcaliDersler.push({
                            ...ders,
                            ders_adi: `${ders.ders_adi}`,
                            ders_sayisi: sure,
                        });
                    });

                });

                // 2. Şartlara Göre Yerleştir
                // Şartları parse et
                let parsedDersProgramiSartlari = [];
                try {
                    parsedDersProgramiSartlari = JSON.parse(dersProgramiSartlari[0]);
                } catch (error) {
                    console.error("Şartlar parse edilemedi:", error);
                    return;
                }

                parsedDersProgramiSartlari.forEach(([dersId, gun, saat, sure]) => {

                    // Ders ID ile ilgili dersi bul
                    const ders = dersler.find(d => d.id == dersId);
                    if (!ders) {
                        console.warn(`Uygun ders bulunamadı: ID ${dersId}`);
                        return;
                    }


                    let atanacakSalon = "Bilinmiyor"; // Varsayılan salon
                    try {
                        const dersSiniflar = Array.isArray(ders.sinif_id) ? ders.sinif_id : JSON.parse(ders.sinif_id || "[]");
                        const dersSaatler = Array.isArray(ders.ders_sinif) ? ders.ders_sinif : JSON.parse(ders.ders_sinif || "[]");

                        // Süreye göre index bul
                        const normalizedSure = Number(sure); // sure değerini sayıya çevir
                        const normalizedDersSaatler = dersSaatler.map(Number); // dersSaatler dizisini sayılara çevir
                        const index = normalizedDersSaatler.indexOf(normalizedSure); // Eşleştirme yap

                        if (index !== -1 && dersSiniflar[index]) {
                            const salon = salonlar.find(salon => salon.id == dersSiniflar[index]);
                            atanacakSalon = salon ? salon.isim : "Bilinmiyor";
                        } else {
                            console.warn('Süreye göre eşleşen salon bulunamadı, rastgele atanacak.');
                            atanacakSalon = salonlar[Math.floor(Math.random() * salonlar.length)].isim; // Rastgele salon ata
                        }
                    } catch (error) {
                        console.error(`sinif_id veya ders_sinif işleme alınamadı: ${error.message}. Rastgele salon atanacak.`);
                        atanacakSalon = salonlar[Math.floor(Math.random() * salonlar.length)].isim; // Rastgele salon ata
                    }

                    console.log(`Atanan Salon: ${atanacakSalon}`);

                    // Çakışma kontrolü
                    let uygunYer = true;
                    for (let i = 0; i < sure; i++) {
                        const kontrolSaat = saat - 1 + i;
                        if (salonKullanim[gun][atanacakSalon]?.[kontrolSaat] || tablo[gun]?.[kontrolSaat]) {
                            uygunYer = false;
                            console.warn(`Çakışma Detayları: Gün: ${gun}, Saat: ${kontrolSaat}, Salon: ${atanacakSalon}`);
                            break;
                        }
                    }

                    // Yerleştirme işlemi
                    if (uygunYer) {
                        console.log(`Ders yerleştiriliyor: ${ders.ders_adi}, Gün: ${gun}, Saat: ${saat}, Süre: ${sure}, Salon: ${atanacakSalon}`);

                        if (!tablo[gun]) {
                            console.error(`Tablo [${gun}] bulunamadı. Gün bilgisi yanlış olabilir.`);
                            return;
                        }

                        // Ders tabloya yerleştirilir
                        tablo[gun][saat - 1] = {
                            dersAdi: `${ders.ders_adi}`,
                            salonAdi: atanacakSalon,
                            colspan: sure,
                        };

                        // Saatleri birleştir
                        for (let i = 1; i < sure; i++) {
                            tablo[gun][saat - 1 + i] = "merged";
                        }

                        // Salon kullanımı güncellenir
                        for (let i = 0; i < sure; i++) {
                            if (!salonKullanim[gun][atanacakSalon]) {
                                salonKullanim[gun][atanacakSalon] = [];
                            }
                            salonKullanim[gun][atanacakSalon][saat - 1 + i] = true;
                        }

                        console.log(`Ders başarıyla tabloya yerleştirildi: ${ders.ders_adi}, Gün: ${gun}, Saat: ${saat}, Salon: ${atanacakSalon}`);
                    } else {
                        console.warn(`Ders yerleştirilemedi: ${ders.ders_adi}, Gün: ${gun}, Saat: ${saat}`);
                    }
                });

                // Tablonun son durumunu kontrol et
                console.log("Son Tablo Durumu:", JSON.stringify(tablo, null, 2));

                // 3. Kalan Dersleri Rastgele Yerleştir
                // Ders ID'lerini parsedDersProgramiSartlari içerisinden al
                const sartlarDersIdleri = parsedDersProgramiSartlari.map(([dersId]) => parseInt(dersId));

                // kalanDersler listesinden parsedDersProgramiSartlari içerisindeki ders ID'lerine sahip olanları çıkar
                const kalanDersler = parcaliDersler.filter(ders => !sartlarDersIdleri.includes(ders.id));

                kalanDersler.forEach((ders, dersIndex) => {
                    const uygunGunler = akademisyenGunleri.find(a => a.akademisyen_id === ders.hoca_id)?.gunler || gunler;

                    for (let deneme = 0; deneme < 100; deneme++) {
                        const rastgeleGun = uygunGunler[Math.floor(Math.random() * uygunGunler.length)];
                        const rastgeleSaat = Math.floor(Math.random() * (gunlukDersSaati - ders.ders_sayisi + 1));

                        // Salon ataması (şartlı veya rastgele)
                        let atanacakSalon = "Bilinmiyor";
                        try {
                            const dersSiniflar = Array.isArray(ders.sinif_id) ? ders.sinif_id : JSON.parse(ders.sinif_id || "[]");
                            const dersSaatler = Array.isArray(ders.ders_sinif) ? ders.ders_sinif : JSON.parse(ders.ders_sinif || "[]");

                            // Süreye göre index bul
                            const index = dersSaatler.indexOf(ders.ders_sayisi);
                            if (index !== -1 && dersSiniflar[index]) {
                                const salon = salonlar.find(salon => salon.id == dersSiniflar[index]);
                                atanacakSalon = salon ? salon.isim : "Bilinmiyor";
                            } else {
                                atanacakSalon = salonlar[Math.floor(Math.random() * salonlar.length)].isim;
                            }
                        } catch (error) {
                            console.error(`Salon ataması sırasında hata: ${error.message}`);
                            atanacakSalon = salonlar[Math.floor(Math.random() * salonlar.length)].isim;
                        }

                        ders.salon = atanacakSalon;

                        // Çakışma kontrolü
                        let uygunYer = true;
                        for (let i = 0; i < ders.ders_sayisi; i++) {
                            const kontrolSaat = rastgeleSaat + i;

                            // Aynı sınıfta çakışma kontrolü
                            if (salonKullanim[rastgeleGun][ders.salon]?.[kontrolSaat] || tablo[rastgeleGun]?.[kontrolSaat]) {
                                uygunYer = false;
                                break;
                            }

                            // Diğer sınıfların aynı salonu kullanıp kullanmadığını kontrol et
                            for (const tabloSinifi in tablo) {
                                if (
                                    tabloSinifi !== ders.sinif.toString() &&
                                    tablo[tabloSinifi]?.[rastgeleGun]?.[kontrolSaat]?.salonAdi === ders.salon
                                ) {
                                    uygunYer = false;
                                    console.warn(
                                        `Çakışma: Salon ${ders.salon} diğer sınıflarda kullanılıyor: Sınıf ${tabloSinifi}, Gün: ${rastgeleGun}, Saat: ${kontrolSaat}`
                                    );
                                    break;
                                }
                            }

                            if (!uygunYer) break;
                        }

                        if (uygunYer) {

                            if (!tablo[rastgeleGun]) {
                                tablo[rastgeleGun] = Array(gunlukDersSaati).fill(null);
                            }

                            tablo[rastgeleGun][rastgeleSaat] = {
                                dersAdi: ders.ders_adi,
                                salonAdi: ders.salon,
                                colspan: ders.ders_sayisi,
                            };

                            for (let i = 1; i < ders.ders_sayisi; i++) {
                                tablo[rastgeleGun][rastgeleSaat + i] = "merged";
                            }

                            for (let i = 0; i < ders.ders_sayisi; i++) {
                                if (!salonKullanim[rastgeleGun][ders.salon]) {
                                    salonKullanim[rastgeleGun][ders.salon] = [];
                                }
                                salonKullanim[rastgeleGun][ders.salon][rastgeleSaat + i] = true;
                            }

                            // Yerleştirilen dersi listeden kaldır
                            const index = parcaliDersler.indexOf(ders);
                            if (index > -1) {
                                parcaliDersler.splice(index, 1);
                            }
                            break; // Bu ders için yerleştirme tamamlandı, döngüyü kır
                        }
                    }

                    if (kalanDersler.includes(ders)) {
                        `console.warn(Ders rastgele yerleştirilemedi: ${ders.ders_adi});`
                    }
                });

                return tablo;
            }


            function renderProgram(container, programTablolari) {
                container.innerHTML = ""; // Önceki içeriği temizle

                programTablolari.forEach(({ sinif, tablo }) => {
                    const table = document.createElement("table");
                    table.classList.add("table", "table-bordered", "my-3");

                    const header = document.createElement("thead");
                    header.innerHTML = `
                        <tr><th colspan="${gunlukDersSaati + 1}" class="text-center"><b>${sinif}. Sınıflar</b></th></tr>
                        <tr>
                            <th scope="col">#</th>
                            ${[...Array(gunlukDersSaati).keys()].map(i => `<th scope="col">${i + 1}</th>`).join("")}
                        </tr>
                    `;
                    table.appendChild(header);

                    const body = document.createElement("tbody");
                    Object.entries(tablo).forEach(([gun, saatler]) => {
                        const row = document.createElement("tr");
                        row.innerHTML = `<th scope="row">${gun}</th>`;
                        saatler.forEach((ders) => {
                            if (ders && typeof ders === "object" && ders !== "merged") {
                                row.innerHTML += `<td colspan="${ders.colspan}" class="text-center">${ders.dersAdi} (${ders.salonAdi})</td>`;
                            } else if (!ders) {
                                row.innerHTML += `<td></td>`;
                            }
                        });
                        body.appendChild(row);
                    });
                    table.appendChild(body);
                    container.appendChild(table);
                });

                // Call the conflict-checking function after rendering the tables
                analyzeScheduleConflicts();
            }

        });

    </script>

<script>

    // Function to check conflicts based on rooms between tables only
    function checkConflicts(tables) {
        const conflicts = [];
        const schedule = {}; // To store room usage per day and time slot

        tables.forEach((table, tableIndex) => {
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach((row) => {
                const day = row.querySelector('th')?.innerText.trim();
                const cells = row.querySelectorAll('td');

                cells.forEach((cell, timeIndex) => {
                    const colSpan = parseInt(cell.getAttribute('colspan') || '1', 10);
                    const content = cell.innerText.trim();

                    // Extract room information from content (e.g., "(207)")
                    const roomMatch = content.match(/\((\d+)\)/);
                    if (roomMatch) {
                        const room = roomMatch[1];

                        for (let i = timeIndex; i < timeIndex + colSpan; i++) {
                            const timeSlot = `${day}-${i}`;

                            if (!schedule[timeSlot]) {
                                schedule[timeSlot] = {};
                            }

                            if (schedule[timeSlot][room]) {
                                const existing = schedule[timeSlot][room];

                                // Ensure conflict is only between different tables
                                if (existing.table !== tableIndex + 1) {
                                    conflicts.push({
                                        table1: existing.table,
                                        table2: tableIndex + 1,
                                        day,
                                        timeSlot: i + 1,
                                        room,
                                        conflict1: existing.content,
                                        conflict2: content,
                                    });
                                }
                            } else {
                                schedule[timeSlot][room] = { table: tableIndex + 1, content };
                            }
                        }
                    }
                });
            });
        });

        return conflicts;
    }

    // Function to resolve conflicts by changing rooms
    function resolveConflicts(conflicts, tables, salonlar, button) {
        let conflictResolved = false; // To track if a conflict is resolved
        const maxAttempts = 20; // Prevent infinite loops by limiting attempts

        conflicts.forEach(conflict => {
            const tableToFix = tables[conflict.table2 - 1]; // Fixing the second table by default
            const rows = tableToFix.querySelectorAll('tbody tr');
            const dayRow = Array.from(rows).find(row => row.querySelector('th')?.innerText.trim() === conflict.day);

            if (dayRow) {
                const cells = dayRow.querySelectorAll('td');
                const targetCell = cells[conflict.timeSlot - 1];
                if (targetCell) {
                    const currentRoom = conflict.room;

                    let newRoom = null;
                    let attempt = 0;

                    // Try to find a suitable room that doesn't create a conflict
                    while (attempt < maxAttempts) {
                        newRoom = salonlar.find(salon => {
                            if (salon.isim === currentRoom) return false;

                            // Check if the new room causes a conflict in this timeslot
                            return !conflicts.some(existingConflict =>
                                existingConflict.day === conflict.day &&
                                existingConflict.timeSlot === conflict.timeSlot &&
                                existingConflict.room === salon.isim
                            );
                        });

                        if (newRoom) {
                            // Change the room in the target cell
                            targetCell.innerText = targetCell.innerText.replace(`(${currentRoom})`, `(${newRoom.isim})`);
                            console.log(`Changed room from ${currentRoom} to ${newRoom.isim} for table ${conflict.table2}, day ${conflict.day}, time slot ${conflict.timeSlot}`);

                            // Recheck conflicts to ensure no new conflicts are created
                            const newConflicts = checkConflicts(tables);
                            if (!newConflicts.some(newConflict =>
                                newConflict.day === conflict.day &&
                                newConflict.timeSlot === conflict.timeSlot &&
                                newConflict.room === newRoom.isim
                            )) {
                                conflictResolved = true;
                                break; // Room change is successful with no new conflicts
                            } else {
                                console.warn(`New conflict detected with room ${newRoom.isim}. Retrying...`);
                            }
                        } else {
                            console.warn(`No available rooms to resolve conflict for table ${conflict.table2}, day ${conflict.day}, time slot ${conflict.timeSlot}`);
                            break;
                        }

                        attempt++;
                    }

                    if (attempt >= maxAttempts) {
                        console.error(`Unable to resolve conflict for table ${conflict.table2}, day ${conflict.day}, time slot ${conflict.timeSlot} after ${maxAttempts} attempts.`);
                    }
                } else {
                    console.warn(`Target cell not found for table ${conflict.table2}, day ${conflict.day}, time slot ${conflict.timeSlot}`);
                }
            } else {
                console.warn(`Day row not found for table ${conflict.table2}, day ${conflict.day}`);
            }
        });

        // If conflicts are still present, click the button to regenerate
        if (conflicts.length > 0) {
            console.log(`Conflicts still present: ${conflicts.length}. Clicking the button to regenerate schedule.`);
            if (button) button.click();
            setTimeout(() => analyzeScheduleConflicts(), 1000); // Re-analyze after 1 second
        } else {
            console.log('All conflicts resolved. No conflicts remain.');
        }
    }

    // Function to display the conflicts
    function displayConflicts(conflicts, container) {
        if (conflicts.length === 0) {
            console.log('No conflicts found.');
            return;
        }

        console.log('Conflicts:', conflicts);

        const conflictTable = document.createElement('table');
        conflictTable.classList.add('table', 'table-bordered', 'my-3');

        const header = document.createElement('thead');
        const headerRow = document.createElement('tr');
        ['Table 1', 'Table 2', 'Day', 'Time Slot', 'Room', 'Conflict 1', 'Conflict 2'].forEach((heading) => {
            const th = document.createElement('th');
            th.innerText = heading;
            headerRow.appendChild(th);
        });
        header.appendChild(headerRow);
        conflictTable.appendChild(header);

        const body = document.createElement('tbody');
        conflicts.forEach((conflict) => {
            const row = document.createElement('tr');
            Object.values(conflict).forEach((value) => {
                const td = document.createElement('td');
                td.innerText = value;
                row.appendChild(td);
            });
            body.appendChild(row);
        });
        container.appendChild(conflictTable);
    }

    // Main function to check and resolve conflicts
    function analyzeScheduleConflicts() {
        const container = document.getElementById('dersprogramıcontainer');
        const button = document.getElementById('programolusturbutton');
        const salonlar = @json($salonlar); // Assuming this gets the list of rooms

        if (!button || !container || !salonlar) {
            console.error('Required elements not found.');
            return;
        }

        function handleConflicts() {
            const tables = container.querySelectorAll('table'); // Ensure tables are re-queried after updates
            let conflicts = checkConflicts(tables);

            if (conflicts.length > 0) {
                console.log(`Conflicts found: ${conflicts.length}. Resolving conflicts or regenerating schedule.`);
                displayConflicts(conflicts, container);
                resolveConflicts(conflicts, tables, salonlar, button);
            } else {
                console.log('No conflicts remain. Schedule is conflict-free.');
            }
        }

        handleConflicts();
    }

</script>
















    


       
@endsection


