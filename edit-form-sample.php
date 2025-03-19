<?php
include('header.php');
?>
<br>

<a href="#" 
                     class="btn btn-info mx-2 mb-2" 
                    data-toggle="modal" data-target="#editCampModal"
                     data-camp_code="<?php echo htmlspecialchars($row['camp_code'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-camp_name="<?php echo htmlspecialchars($row['camp_name'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-camp_start_date="<?php echo htmlspecialchars($row['camp_start_date'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-camp_end_date="<?php echo htmlspecialchars($row['camp_end_date'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-delivery_days="<?php echo htmlspecialchars($row['delivery_days'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-lead_goal="<?php echo htmlspecialchars($row['lead_goal'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-weekly_lead="<?php echo htmlspecialchars($row['weekly_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-delivered_lead="<?php echo htmlspecialchars($row['delivered_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-undelivered_lead="<?php echo htmlspecialchars($row['undelivered_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-pending_lead="<?php echo htmlspecialchars($row['pending_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-extra_lead="<?php echo htmlspecialchars($row['extra_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-generated_lead="<?php echo htmlspecialchars($row['generated_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-country="<?php echo htmlspecialchars($row['country'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-company_size="<?php echo htmlspecialchars($row['company_size'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-job_title="<?php echo htmlspecialchars($row['job_title'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-job_level="<?php echo htmlspecialchars($row['job_level'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-industry="<?php echo htmlspecialchars($row['industry'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-custm_que="<?php echo htmlspecialchars($row['custm_que'], ENT_QUOTES, 'UTF-8'); ?>"
                     data-camp_status="<?php echo htmlspecialchars($row['camp_status'], ENT_QUOTES, 'UTF-8'); ?>"> 
                     Edit </a>

<div class="modal fade" id="editCampModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="editCampModalLabel">Edit Campaign</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="update-campaign.php" name="campaignUpdateForm" id="campaignUpdateForm" method="POST" class="form_style">
                        <!-- <div class="text-center">
                           <img src="http://localhost/crm1/logo1.jpg" class="img-fluid" align="center" style="margin: 30px 10px 0px 10px;" alt="">
                        </div>
                        <br> -->
                        <div class="mb-3">
                           <label for="camp_code" class="form-label">Campaign Code</label>
                           <input type="text" class="form-control" id="camp_code_update" name="camp_code" required="">
                        </div>
                        <div class="mb-3">
                           <label for="camp_name" class="form-label">Campaign Name</label>
                           <input type="text" name="camp_name" class="form-control" id="camp_name_update" required="">
                        </div>
                        <div class="mb-3">
                           <label for="camp_start_date" class="form-label">Campaign Start Date</label>
                           <input type="date" name="camp_start_date" class="form-control" id="camp_start_date_update" required="">
                        </div>
                        <div class="mb-3">
                           <label for="camp_end_date" class="form-label">Campaign End Date</label>
                           <input type="date" name="camp_end_date" class="form-control" id="camp_end_date_update" required="">
                        </div>
                        <div class="mb-3">
                           <label>Delivery Days:</label>
                           <div class="checkbox-group">
                              <label><input type="checkbox" name="delivery_days[]" value="Monday"> Monday</label>
                              <label><input type="checkbox" name="delivery_days[]" value="Tuesday"> Tuesday</label>
                              <label><input type="checkbox" name="delivery_days[]" value="Wednesday"> Wednesday</label>
                              <label><input type="checkbox" name="delivery_days[]" value="Thursday"> Thursday</label>
                              <label><input type="checkbox" name="delivery_days[]" value="Friday"> Friday</label>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="lead_goal" class="form-label">Lead Goal</label>
                           <input type="number" name="lead_goal" class="form-control" id="lead_goal_update" required="">
                        </div>
                        <div class="mb-3">
                           <label for="weekly_lead" class="form-label">Weekly Leads</label>
                           <input type="number" name="weekly_lead" class="form-control" id="weekly_lead_update" required="">
                        </div>
                        <div class="mb-3">
                           <label for="delivered_lead" class="form-label">Delivered Leads</label>
                           <input type="number" name="delivered_lead" class="form-control" id="delivered_lead_update">
                        </div>
                        <!-- <div class="mb-3">
                           <label for="undelivered_lead" class="form-label">Undelivered Leads</label>
                           <input type="number" name="undelivered_lead" class="form-control" id="undelivered_lead_update" >
                           </div> -->
                        <!-- <div class="mb-3">
                           <label for="pending_lead" class="form-label">Pending Leads</label>
                           <input type="number" name="pending_lead" class="form-control" id="pending_lead_update" >
                           </div> -->
                        <!-- <div class="mb-3">
                           <label for="extra_lead" class="form-label">Extra Leads</label>
                           <input type="number" name="extra_lead" class="form-control" id="extra_lead_update" >
                           </div> -->
                        <div class="mb-3">
                           <label for="generated_lead" class="form-label">Generated Leads</label>
                           <input type="number" name="generated_lead" class="form-control" id="generated_lead_update">
                        </div>
                        <div class="mb-3">
                           <label for="country">Country</label>
                           <select class="form-control select2-hidden-accessible" id="country_select_update" name="country[]" multiple="" style="width: 100%;" required="" data-select2-id="select2-data-country_select_update" tabindex="-1" aria-hidden="true">
                              <option value="﻿AFGHANISTAN">﻿AFGHANISTAN</option>
                              <option value="ALBANIA">ALBANIA</option>
                              <option value="ALGERIA">ALGERIA</option>
                              <option value="AMERICAN SAMOA">AMERICAN SAMOA</option>
                              <option value="ANDORRA">ANDORRA</option>
                              <option value="ANGOLA">ANGOLA</option>
                              <option value="ANGUILLA">ANGUILLA</option>
                              <option value="ANTARCTICA">ANTARCTICA</option>
                              <option value="ANTIGUA AND BARBUDA">ANTIGUA AND BARBUDA</option>
                              <option value="ARGENTINA">ARGENTINA</option>
                              <option value="ARMENIA">ARMENIA</option>
                              <option value="ARUBA">ARUBA</option>
                              <option value="AUSTRALIA">AUSTRALIA</option>
                              <option value="AUSTRIA">AUSTRIA</option>
                              <option value="AZERBAIJAN">AZERBAIJAN</option>
                              <option value="BAHAMAS">BAHAMAS</option>
                              <option value="BAHRAIN">BAHRAIN</option>
                              <option value="BANGLADESH">BANGLADESH</option>
                              <option value="BARBADOS">BARBADOS</option>
                              <option value="BELARUS">BELARUS</option>
                              <option value="BELGIUM">BELGIUM</option>
                              <option value="BELIZE">BELIZE</option>
                              <option value="BENIN">BENIN</option>
                              <option value="BERMUDA">BERMUDA</option>
                              <option value="BHUTAN">BHUTAN</option>
                              <option value="BOLIVIA">BOLIVIA</option>
                              <option value="BOSNIA AND HERZEGOVINA">BOSNIA AND HERZEGOVINA</option>
                              <option value="BOTSWANA">BOTSWANA</option>
                              <option value="BOUVET ISLAND">BOUVET ISLAND</option>
                              <option value="BRAZIL">BRAZIL</option>
                              <option value="BRITISH INDIAN OCEAN TERRITORY">BRITISH INDIAN OCEAN TERRITORY</option>
                              <option value="BRUNEI DARUSSALAM">BRUNEI DARUSSALAM</option>
                              <option value="BULGARIA">BULGARIA</option>
                              <option value="BURKINA FASO">BURKINA FASO</option>
                              <option value="BURUNDI">BURUNDI</option>
                              <option value="CAMBODIA">CAMBODIA</option>
                              <option value="CAMEROON">CAMEROON</option>
                              <option value="CANADA">CANADA</option>
                              <option value="CAPE VERDE">CAPE VERDE</option>
                              <option value="CAYMAN ISLANDS">CAYMAN ISLANDS</option>
                              <option value="CENTRAL AFRICAN REPUBLIC">CENTRAL AFRICAN REPUBLIC</option>
                              <option value="CHAD">CHAD</option>
                              <option value="CHILE">CHILE</option>
                              <option value="CHINA">CHINA</option>
                              <option value="CHRISTMAS ISLAND">CHRISTMAS ISLAND</option>
                              <option value="COCOS (KEELING) ISLANDS">COCOS (KEELING) ISLANDS</option>
                              <option value="COLOMBIA">COLOMBIA</option>
                              <option value="COMOROS">COMOROS</option>
                              <option value="CONGO">CONGO</option>
                              <option value="CONGO, THE DEMOCRATIC REPUBLIC OF THE">CONGO, THE DEMOCRATIC REPUBLIC OF THE</option>
                              <option value="COOK ISLANDS">COOK ISLANDS</option>
                              <option value="COSTA RICA">COSTA RICA</option>
                              <option value="COTE D'IVOIRE">COTE D'IVOIRE</option>
                              <option value="CROATIA">CROATIA</option>
                              <option value="CUBA">CUBA</option>
                              <option value="CYPRUS">CYPRUS</option>
                              <option value="CZECH REPUBLIC">CZECH REPUBLIC</option>
                              <option value="DENMARK">DENMARK</option>
                              <option value="DJIBOUTI">DJIBOUTI</option>
                              <option value="DOMINICA">DOMINICA</option>
                              <option value="DOMINICAN REPUBLIC">DOMINICAN REPUBLIC</option>
                              <option value="ECUADOR">ECUADOR</option>
                              <option value="EGYPT">EGYPT</option>
                              <option value="EL SALVADOR">EL SALVADOR</option>
                              <option value="ELAND ISLANDS">ELAND ISLANDS</option>
                              <option value="EQUATORIAL GUINEA">EQUATORIAL GUINEA</option>
                              <option value="ERITREA">ERITREA</option>
                              <option value="ESTONIA">ESTONIA</option>
                              <option value="ETHIOPIA">ETHIOPIA</option>
                              <option value="FALKLAND ISLANDS (MALVINAS)">FALKLAND ISLANDS (MALVINAS)</option>
                              <option value="FAROE ISLANDS">FAROE ISLANDS</option>
                              <option value="FIJI">FIJI</option>
                              <option value="FINLAND">FINLAND</option>
                              <option value="FRANCE">FRANCE</option>
                              <option value="FRENCH GUIANA">FRENCH GUIANA</option>
                              <option value="FRENCH POLYNESIA">FRENCH POLYNESIA</option>
                              <option value="FRENCH SOUTHERN TERRITORIES">FRENCH SOUTHERN TERRITORIES</option>
                              <option value="GABON">GABON</option>
                              <option value="GAMBIA">GAMBIA</option>
                              <option value="GEORGIA">GEORGIA</option>
                              <option value="GERMANY">GERMANY</option>
                              <option value="GHANA">GHANA</option>
                              <option value="GIBRALTAR">GIBRALTAR</option>
                              <option value="GREECE">GREECE</option>
                              <option value="GREENLAND">GREENLAND</option>
                              <option value="GRENADA">GRENADA</option>
                              <option value="GUADELOUPE">GUADELOUPE</option>
                              <option value="GUAM">GUAM</option>
                              <option value="GUATEMALA">GUATEMALA</option>
                              <option value="GUINEA">GUINEA</option>
                              <option value="GUINEA-BISSAU">GUINEA-BISSAU</option>
                              <option value="GUYANA">GUYANA</option>
                              <option value="HAITI">HAITI</option>
                              <option value="HEARD ISLAND AND MCDONALD ISLANDS">HEARD ISLAND AND MCDONALD ISLANDS</option>
                              <option value="HOLY SEE (VATICAN CITY STATE)">HOLY SEE (VATICAN CITY STATE)</option>
                              <option value="HONDURAS">HONDURAS</option>
                              <option value="HONG KONG">HONG KONG</option>
                              <option value="HUNGARY">HUNGARY</option>
                              <option value="ICELAND">ICELAND</option>
                              <option value="INDIA">INDIA</option>
                              <option value="INDONESIA">INDONESIA</option>
                              <option value="IRAN, ISLAMIC REPUBLIC OF">IRAN, ISLAMIC REPUBLIC OF</option>
                              <option value="IRAQ">IRAQ</option>
                              <option value="IRELAND">IRELAND</option>
                              <option value="ISRAEL">ISRAEL</option>
                              <option value="ITALY">ITALY</option>
                              <option value="JAMAICA">JAMAICA</option>
                              <option value="JAPAN">JAPAN</option>
                              <option value="JORDAN">JORDAN</option>
                              <option value="KAZAKHSTAN">KAZAKHSTAN</option>
                              <option value="KENYA">KENYA</option>
                              <option value="KIRIBATI">KIRIBATI</option>
                              <option value="KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF">KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF</option>
                              <option value="KOREA, REPUBLIC OF">KOREA, REPUBLIC OF</option>
                              <option value="KUWAIT">KUWAIT</option>
                              <option value="KYRGYZSTAN">KYRGYZSTAN</option>
                              <option value="LAO PEOPLE'S DEMOCRATIC REPUBLIC">LAO PEOPLE'S DEMOCRATIC REPUBLIC</option>
                              <option value="LATVIA">LATVIA</option>
                              <option value="LEBANON">LEBANON</option>
                              <option value="LESOTHO">LESOTHO</option>
                              <option value="LIBERIA">LIBERIA</option>
                              <option value="LIBYAN ARAB JAMAHIRIYA">LIBYAN ARAB JAMAHIRIYA</option>
                              <option value="LIECHTENSTEIN">LIECHTENSTEIN</option>
                              <option value="LITHUANIA">LITHUANIA</option>
                              <option value="LUXEMBOURG">LUXEMBOURG</option>
                              <option value="MACAO">MACAO</option>
                              <option value="MACEDONIA">MACEDONIA</option>
                              <option value="MADAGASCAR">MADAGASCAR</option>
                              <option value="MALAWI">MALAWI</option>
                              <option value="MALAYSIA">MALAYSIA</option>
                              <option value="MALDIVES">MALDIVES</option>
                              <option value="MALI">MALI</option>
                              <option value="MALTA">MALTA</option>
                              <option value="MARSHALL ISLANDS">MARSHALL ISLANDS</option>
                              <option value="MARTINIQUE">MARTINIQUE</option>
                              <option value="MAURITANIA">MAURITANIA</option>
                              <option value="MAURITIUS">MAURITIUS</option>
                              <option value="MAYOTTE">MAYOTTE</option>
                              <option value="MEXICO">MEXICO</option>
                              <option value="MICRONESIA, FEDERATED STATES OF">MICRONESIA, FEDERATED STATES OF</option>
                              <option value="MOLDOVA, REPUBLIC OF">MOLDOVA, REPUBLIC OF</option>
                              <option value="MONACO">MONACO</option>
                              <option value="MONGOLIA">MONGOLIA</option>
                              <option value="MONTSERRAT">MONTSERRAT</option>
                              <option value="MOROCCO">MOROCCO</option>
                              <option value="MOZAMBIQUE">MOZAMBIQUE</option>
                              <option value="MYANMAR">MYANMAR</option>
                              <option value="NAMIBIA">NAMIBIA</option>
                              <option value="NAURU">NAURU</option>
                              <option value="NEPAL">NEPAL</option>
                              <option value="NETHERLANDS">NETHERLANDS</option>
                              <option value="NETHERLANDS ANTILLES">NETHERLANDS ANTILLES</option>
                              <option value="NEW CALEDONIA">NEW CALEDONIA</option>
                              <option value="NEW ZEALAND">NEW ZEALAND</option>
                              <option value="NICARAGUA">NICARAGUA</option>
                              <option value="NIGER">NIGER</option>
                              <option value="NIGERIA">NIGERIA</option>
                              <option value="NIUE">NIUE</option>
                              <option value="NORFOLK ISLAND">NORFOLK ISLAND</option>
                              <option value="NORTHERN MARIANA ISLANDS">NORTHERN MARIANA ISLANDS</option>
                              <option value="NORWAY">NORWAY</option>
                              <option value="OMAN">OMAN</option>
                              <option value="PAKISTAN">PAKISTAN</option>
                              <option value="PALAU">PALAU</option>
                              <option value="PALESTINIAN TERRITORY, OCCUPIED">PALESTINIAN TERRITORY, OCCUPIED</option>
                              <option value="PANAMA">PANAMA</option>
                              <option value="PAPUA NEW GUINEA">PAPUA NEW GUINEA</option>
                              <option value="PARAGUAY">PARAGUAY</option>
                              <option value="PERU">PERU</option>
                              <option value="PHILIPPINES">PHILIPPINES</option>
                              <option value="PITCAIRN">PITCAIRN</option>
                              <option value="POLAND">POLAND</option>
                              <option value="PORTUGAL">PORTUGAL</option>
                              <option value="PUERTO RICO">PUERTO RICO</option>
                              <option value="QATAR">QATAR</option>
                              <option value="REUNION">REUNION</option>
                              <option value="ROMANIA">ROMANIA</option>
                              <option value="RUSSIAN FEDERATION">RUSSIAN FEDERATION</option>
                              <option value="RWANDA">RWANDA</option>
                              <option value="SAINT HELENA">SAINT HELENA</option>
                              <option value="SAINT KITTS AND NEVIS">SAINT KITTS AND NEVIS</option>
                              <option value="SAINT LUCIA">SAINT LUCIA</option>
                              <option value="SAINT PIERRE AND MIQUELON">SAINT PIERRE AND MIQUELON</option>
                              <option value="SAINT VINCENT AND THE GRENADINES">SAINT VINCENT AND THE GRENADINES</option>
                              <option value="SAMOA">SAMOA</option>
                              <option value="SAN MARINO">SAN MARINO</option>
                              <option value="SAO TOME AND PRINCIPE">SAO TOME AND PRINCIPE</option>
                              <option value="SAUDI ARABIA">SAUDI ARABIA</option>
                              <option value="SENEGAL">SENEGAL</option>
                              <option value="SERBIA">SERBIA</option>
                              <option value="SERBIA AND MONTENEGRO">SERBIA AND MONTENEGRO</option>
                              <option value="SEYCHELLES">SEYCHELLES</option>
                              <option value="SIERRA LEONE">SIERRA LEONE</option>
                              <option value="SINGAPORE">SINGAPORE</option>
                              <option value="SLOVAKIA">SLOVAKIA</option>
                              <option value="SLOVENIA">SLOVENIA</option>
                              <option value="SOLOMON ISLANDS">SOLOMON ISLANDS</option>
                              <option value="SOMALIA">SOMALIA</option>
                              <option value="SOUTH AFRICA">SOUTH AFRICA</option>
                              <option value="SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS">SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS</option>
                              <option value="SPAIN">SPAIN</option>
                              <option value="SRI LANKA">SRI LANKA</option>
                              <option value="SUDAN">SUDAN</option>
                              <option value="SURINAME">SURINAME</option>
                              <option value="SVALBARD AND JAN MAYEN">SVALBARD AND JAN MAYEN</option>
                              <option value="SWAZILAND">SWAZILAND</option>
                              <option value="SWEDEN">SWEDEN</option>
                              <option value="SWITZERLAND">SWITZERLAND</option>
                              <option value="SYRIAN ARAB REPUBLIC">SYRIAN ARAB REPUBLIC</option>
                              <option value="TAIWAN, PROVINCE OF CHINA">TAIWAN, PROVINCE OF CHINA</option>
                              <option value="TAJIKISTAN">TAJIKISTAN</option>
                              <option value="TANZANIA, UNITED REPUBLIC OF">TANZANIA, UNITED REPUBLIC OF</option>
                              <option value="THAILAND">THAILAND</option>
                              <option value="TIMOR-LESTE">TIMOR-LESTE</option>
                              <option value="TOGO">TOGO</option>
                              <option value="TOKELAU">TOKELAU</option>
                              <option value="TONGA">TONGA</option>
                              <option value="TRINIDAD AND TOBAGO">TRINIDAD AND TOBAGO</option>
                              <option value="TUNISIA">TUNISIA</option>
                              <option value="TURKEY">TURKEY</option>
                              <option value="TURKMENISTAN">TURKMENISTAN</option>
                              <option value="TURKS AND CAICOS ISLANDS">TURKS AND CAICOS ISLANDS</option>
                              <option value="TUVALU">TUVALU</option>
                              <option value="UGANDA">UGANDA</option>
                              <option value="UKRAINE">UKRAINE</option>
                              <option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option>
                              <option value="UNITED KINGDOM">UNITED KINGDOM</option>
                              <option value="UNITED STATES">UNITED STATES</option>
                              <option value="UNITED STATES MINOR OUTLYING ISLANDS">UNITED STATES MINOR OUTLYING ISLANDS</option>
                              <option value="URUGUAY">URUGUAY</option>
                              <option value="UZBEKISTAN">UZBEKISTAN</option>
                              <option value="VANUATU">VANUATU</option>
                              <option value="VENEZUELA">VENEZUELA</option>
                              <option value="VIET NAM">VIET NAM</option>
                              <option value="VIRGIN ISLANDS, BRITISH">VIRGIN ISLANDS, BRITISH</option>
                              <option value="VIRGIN ISLANDS, U.S.">VIRGIN ISLANDS, U.S.</option>
                              <option value="WALLIS AND FUTUNA">WALLIS AND FUTUNA</option>
                              <option value="WESTERN SAHARA">WESTERN SAHARA</option>
                              <option value="YEMEN">YEMEN</option>
                              <option value="ZAMBIA">ZAMBIA</option>
                              <option value="ZIMBABWE">ZIMBABWE</option>
                           </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-1-13i6" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-country_select_update-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-country_select_update-container" placeholder="" style="width: 0.75em;"></textarea></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                        <div class="mb-3">
                           <label for="company_size">Company Size</label>
                           <select class="form-control select2-hidden-accessible" id="company_size_select_update" name="company_size[]" multiple="" style="width: 100%;" required="" data-select2-id="select2-data-company_size_select_update" tabindex="-1" aria-hidden="true">
                              <option value="1-10">1-10</option>
                              <option value="11-50">11-50</option>
                              <option value="51-100">51-100</option>
                              <option value="101-500">101-500</option>
                              <option value="501-1000">501-1000</option>
                              <option value="1000+">1000+</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-2-2tg7" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-company_size_select_update-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-company_size_select_update-container" placeholder="" style="width: 0.75em;"></textarea></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                        <div class="mb-3">
                           <label for="job_title">Job Titles</label>
                           <select class="form-control select2-hidden-accessible" id="job_title_select_update" name="job_title[]" multiple="" style="width: 100%;" required="" data-select2-id="select2-data-job_title_select_update" tabindex="-1" aria-hidden="true">
                              <option value="Application / Software Development">Application / Software Development</option>
                              <option value="Application Management: Finance">Application Management: Finance</option>
                              <option value="Application Management: HR">Application Management: HR</option>
                              <option value="Application Management: Healthcare">Application Management: Healthcare</option>
                              <option value="Application Management: Integration / Middleware">Application Management: Integration / Middleware</option>
                           </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-3-buzr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-job_title_select_update-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-job_title_select_update-container" placeholder="" style="width: 0.75em;"></textarea></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                        <div class="mb-3">
                           <label for="job_level">Job Level</label>
                           <select class="form-control select2-hidden-accessible" id="job_level_select_update" name="job_level[]" multiple="" style="width: 100%;" required="" data-select2-id="select2-data-job_level_select_update" tabindex="-1" aria-hidden="true">
                              <option value="Architect">Architect</option>
                              <option value="C-Level / Executive Team">C-Level / Executive Team</option>
                              <option value="Director">Director</option>
                              <option value="EVP / SVP / VP / AVP">EVP / SVP / VP / AVP</option>
                              <option value="Manager">Manager</option>
                           </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-4-4uuo" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-job_level_select_update-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-job_level_select_update-container" placeholder="" style="width: 0.75em;"></textarea></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                        <div class="mb-3">
                           <label for="industry">Industry</label>
                           <select class="form-control select2-hidden-accessible" id="industry_update" name="industry[]" multiple="" style="width: 100%;" required="" data-select2-id="select2-data-industry_update" tabindex="-1" aria-hidden="true">
                              <option value="Accountable Care Organization">Accountable Care Organization</option>
                              <option value="Accounting">Accounting</option>
                              <option value="Agriculture/Forestry">Agriculture/Forestry</option>
                              <option value="Airlines/Aviation">Airlines/Aviation</option>
                              <option value="Alternative Dispute Resolution">Alternative Dispute Resolution</option>
                              <option value="Alternative Medicine">Alternative Medicine</option>
                              <option value="Ancillary Clinical Service Provider">Ancillary Clinical Service Provider</option>
                              <option value="Animation">Animation</option>
                              <option value="Apparel &amp; Fashion">Apparel &amp; Fashion</option>
                              <option value="Architecture &amp; Planning">Architecture &amp; Planning</option>
                              <option value="Architecture and Engineering">Architecture and Engineering</option>
                              <option value="Arts and Crafts">Arts and Crafts</option>
                              <option value="Automotive">Automotive</option>
                              <option value="Aviation &amp; Aerospace">Aviation &amp; Aerospace</option>
                              <option value="Banking">Banking</option>
                              <option value="Biomedical Engineering">Biomedical Engineering</option>
                              <option value="Biotechnology">Biotechnology</option>
                              <option value="Broadcast Media">Broadcast Media</option>
                              <option value="Building Materials">Building Materials</option>
                              <option value="Business Supplies and Equipment">Business Supplies and Equipment</option>
                              <option value="Business services">Business services</option>
                              <option value="Capital Markets">Capital Markets</option>
                              <option value="Chemicals">Chemicals</option>
                              <option value="Civic &amp; Social Organization">Civic &amp; Social Organization</option>
                              <option value="Civil Engineering">Civil Engineering</option>
                              <option value="Clinical Research Organization">Clinical Research Organization</option>
                              <option value="Commercial Real Estate">Commercial Real Estate</option>
                              <option value="Computer And Computer Peripheral Equipment And Software Merchant Wholesalers">Computer And Computer Peripheral Equipment And Software Merchant Wholesalers</option>
                              <option value="Construction">Construction</option>
                              <option value="Consumer Electronics">Consumer Electronics</option>
                              <option value="Consumer Goods">Consumer Goods</option>
                              <option value="Consumer Goods &amp; Services">Consumer Goods &amp; Services</option>
                              <option value="Consumer Services">Consumer Services</option>
                              <option value="Cosmetics">Cosmetics</option>
                              <option value="Dairy">Dairy</option>
                              <option value="Defense &amp; Space">Defense &amp; Space</option>
                              <option value="Design">Design</option>
                              <option value="E-Learning">E-Learning</option>
                              <option value="Education">Education</option>
                              <option value="Education Management">Education Management</option>
                              <option value="Electrical/Electronic Manufacturing">Electrical/Electronic Manufacturing</option>
                              <option value="Entertainment">Entertainment</option>
                              <option value="Environmental Services">Environmental Services</option>
                              <option value="Events Services">Events Services</option>
                              <option value="Executive Office">Executive Office</option>
                              <option value="Facilities Services">Facilities Services</option>
                              <option value="Farming">Farming</option>
                              <option value="Federal/State/Municipal Health Agency">Federal/State/Municipal Health Agency</option>
                              <option value="Financial Services">Financial Services</option>
                              <option value="Financial/Banking">Financial/Banking</option>
                              <option value="Fine Art">Fine Art</option>
                              <option value="Fishery">Fishery</option>
                              <option value="Food &amp; Beverages">Food &amp; Beverages</option>
                              <option value="Food Production">Food Production</option>
                              <option value="Fund-Raising">Fund-Raising</option>
                              <option value="Furniture">Furniture</option>
                              <option value="Gambling &amp; Casinos">Gambling &amp; Casinos</option>
                              <option value="Glass, Ceramics &amp; Concrete">Glass, Ceramics &amp; Concrete</option>
                              <option value="Government &amp; Public Policy">Government &amp; Public Policy</option>
                              <option value="Government Administration">Government Administration</option>
                              <option value="Government Relations">Government Relations</option>
                              <option value="Graphic Design">Graphic Design</option>
                              <option value="Health, Wellness and Fitness">Health, Wellness and Fitness</option>
                              <option value="Healthcare/Health Services">Healthcare/Health Services</option>
                              <option value="Higher Education">Higher Education</option>
                              <option value="Hospital &amp; Health Care">Hospital &amp; Health Care</option>
                              <option value="Hospital/Medical Center/Multi-Hospital System/IDN">Hospital/Medical Center/Multi-Hospital System/IDN</option>
                              <option value="Hospitality">Hospitality</option>
                              <option value="Human Resources">Human Resources</option>
                              <option value="Import and Export">Import and Export</option>
                              <option value="Individual &amp; Family Services">Individual &amp; Family Services</option>
                              <option value="Industrial Automation">Industrial Automation</option>
                              <option value="Information Services">Information Services</option>
                              <option value="Insurance">Insurance</option>
                              <option value="Insurance (non-Healthcare)">Insurance (non-Healthcare)</option>
                              <option value="International Affairs">International Affairs</option>
                              <option value="International Trade and Development">International Trade and Development</option>
                              <option value="Internet">Internet</option>
                              <option value="Investment Banking">Investment Banking</option>
                              <option value="Investment Management">Investment Management</option>
                              <option value="Judiciary">Judiciary</option>
                              <option value="Law Enforcement">Law Enforcement</option>
                              <option value="Law Practice">Law Practice</option>
                              <option value="Legal services">Legal services</option>
                              <option value="Legislative Office">Legislative Office</option>
                              <option value="Leisure, Travel &amp; Tourism">Leisure, Travel &amp; Tourism</option>
                              <option value="Libraries">Libraries</option>
                              <option value="Life Sciences">Life Sciences</option>
                              <option value="Logistics and Supply Chain">Logistics and Supply Chain</option>
                              <option value="Luxury Goods &amp; Jewelry">Luxury Goods &amp; Jewelry</option>
                              <option value="Machinery">Machinery</option>
                              <option value="Management Consulting">Management Consulting</option>
                              <option value="Manufacturing/Industrial (non-computer related)">Manufacturing/Industrial (non-computer related)</option>
                              <option value="Maritime">Maritime</option>
                              <option value="Market Research">Market Research</option>
                              <option value="Marketing and Advertising">Marketing and Advertising</option>
                              <option value="Mechanical or Industrial Engineering">Mechanical or Industrial Engineering</option>
                              <option value="Media Production">Media Production</option>
                              <option value="Medical Devices">Medical Devices</option>
                              <option value="Medical Practice">Medical Practice</option>
                              <option value="Mental Health Care">Mental Health Care</option>
                              <option value="Military">Military</option>
                              <option value="Mining &amp; Metals">Mining &amp; Metals</option>
                              <option value="Mobile Games">Mobile Games</option>
                              <option value="Motion Pictures and Film">Motion Pictures and Film</option>
                              <option value="Museums and Institutions">Museums and Institutions</option>
                              <option value="Music">Music</option>
                              <option value="Nanotechnology">Nanotechnology</option>
                              <option value="Newspapers">Newspapers</option>
                              <option value="Nonprofit Organization Management">Nonprofit Organization Management</option>
                              <option value="Oil &amp; Energy">Oil &amp; Energy</option>
                              <option value="Oil/Gas/Mining/Other natural resources">Oil/Gas/Mining/Other natural resources</option>
                              <option value="Online Media">Online Media</option>
                              <option value="Other">Other</option>
                              <option value="Outpatient Center">Outpatient Center</option>
                              <option value="Outsourcing/Offshoring">Outsourcing/Offshoring</option>
                              <option value="Package/Freight Delivery">Package/Freight Delivery</option>
                              <option value="Packaging and Containers">Packaging and Containers</option>
                              <option value="Paper &amp; Forest Products">Paper &amp; Forest Products</option>
                              <option value="Payer/Insurance Company/Managed Care Organization">Payer/Insurance Company/Managed Care Organization</option>
                              <option value="Performing Arts">Performing Arts</option>
                              <option value="Pharmaceuticals">Pharmaceuticals</option>
                              <option value="Philanthropy">Philanthropy</option>
                              <option value="Photography">Photography</option>
                              <option value="Physician Practice/Physician Group">Physician Practice/Physician Group</option>
                              <option value="Plastics">Plastics</option>
                              <option value="Political Organization">Political Organization</option>
                              <option value="Primary/Secondary Education">Primary/Secondary Education</option>
                              <option value="Printing">Printing</option>
                              <option value="Professional Training &amp; Coaching">Professional Training &amp; Coaching</option>
                              <option value="Program Development">Program Development</option>
                              <option value="Public Policy">Public Policy</option>
                              <option value="Public Relations and Communications">Public Relations and Communications</option>
                              <option value="Public Safety">Public Safety</option>
                              <option value="Publishing">Publishing</option>
                              <option value="Publishing/Broadcast/Media">Publishing/Broadcast/Media</option>
                              <option value="Railroad Manufacture">Railroad Manufacture</option>
                              <option value="Ranching">Ranching</option>
                              <option value="Real Estate">Real Estate</option>
                              <option value="Recreation/Entertainment">Recreation/Entertainment</option>
                              <option value="Recreational Facilities and Services">Recreational Facilities and Services</option>
                              <option value="Religious Institutions">Religious Institutions</option>
                              <option value="Renewables &amp; Environment">Renewables &amp; Environment</option>
                              <option value="Research">Research</option>
                              <option value="Research and Consulting">Research and Consulting</option>
                              <option value="Restaurants">Restaurants</option>
                              <option value="Retail">Retail</option>
                              <option value="Security and Investigations">Security and Investigations</option>
                              <option value="Semiconductors">Semiconductors</option>
                              <option value="Shipbuilding">Shipbuilding</option>
                              <option value="Skilled Nursing Facility">Skilled Nursing Facility</option>
                              <option value="Sporting Goods">Sporting Goods</option>
                              <option value="Sports">Sports</option>
                              <option value="Staffing and Recruiting">Staffing and Recruiting</option>
                              <option value="Supermarkets">Supermarkets</option>
                              <option value="Telecommunications">Telecommunications</option>
                              <option value="Textiles">Textiles</option>
                              <option value="Think Tanks">Think Tanks</option>
                              <option value="Tobacco">Tobacco</option>
                              <option value="Translation and Localization">Translation and Localization</option>
                              <option value="Transportation/Distribution">Transportation/Distribution</option>
                              <option value="Transportation/Trucking/Railroad">Transportation/Trucking/Railroad</option>
                              <option value="Travel/Hospitality">Travel/Hospitality</option>
                              <option value="Utilities">Utilities</option>
                              <option value="Venture Capital &amp; Private Equity">Venture Capital &amp; Private Equity</option>
                              <option value="Veterinary">Veterinary</option>
                              <option value="Warehousing">Warehousing</option>
                              <option value="Wholesale">Wholesale</option>
                              <option value="Wine and Spirits">Wine and Spirits</option>
                              <option value="Wireless">Wireless</option>
                              <option value="Writing and Editing">Writing and Editing</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-5-r1xa" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-industry_update-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-industry_update-container" placeholder="" style="width: 0.75em;"></textarea></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                        <div class="mb-3">
                           <label for="custm_que">Custom Question</label>
                           <select class="form-control" id="custm_que_update" name="custm_que" required="">
                              <option selected="" disabled="" value=""> Custom Question</option>
                              <option value="yes">yes</option>
                              <option value="no">no</option>
                           </select>
                        </div> 
                        <div class="mb-3">
                           <label for="camp_status" class="form-label">Campaign Status</label>
                           <select name="camp_status" id="camp_status_update" class="form-control" required="">
                              <option value="" disabled="">Select Status</option>
                              <option value="Pending">Pending</option>
                              <option value="Live">Live</option>
                              <option value="Pause">Pause</option>
                              <option value="Completed">Completed</option>
                              <option value="Stop">Stop</option>
                           </select>
                        </div>
                        <div class="modal-footer">
                           <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                           <button type="submit" name="submit" class="btn btn-primary">Save</button>
                        </div>
                     </form>
      </div>
     
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS (if used) -->
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
<script>
   $(document).ready(function() {
       try {
           var urlParams = new URLSearchParams(window.location.search);
           var section = urlParams.get('section') || 'dashboard';
           
           // Capitalize the first letter and ensure it matches the ID
           var sectionId = 'view' + section.charAt(0).toUpperCase() + section.slice(1);
           
           // Show the selected section and hide others
           $('#' + sectionId).show().siblings('div[id^="view"]').hide();
           
           // Set the active class on the nav
           $('.nav-link').removeClass('active');
           $('.nav-link[href="?section=' + section + '"]').addClass('active');
       } catch (error) {
           console.error('Error setting up the dashboard:', error);
       }
   });
</script>
<script>
   $(document).ready(function() {
    // Initialize Select2 for all relevant fields
    $('#country_select_update, #company_size_select_update, #job_title_select_update, #job_level_select_update, #industry_update').select2({
        placeholder: function() {
            $(this).data('placeholder');
        },
        allowClear: true
    });
   
    $('#editCampModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
   
        // Extract data attributes
        var data = button.data();
        var modal = $(this);
   
        // Populate the modal fields
        modal.find('#camp_code_update').val(data.camp_code);
        modal.find('#camp_name_update').val(data.camp_name);
        modal.find('#camp_start_date_update').val(data.camp_start_date);
        modal.find('#camp_end_date_update').val(data.camp_end_date);
        modal.find('#weekly_lead_update').val(data.weekly_lead);
        modal.find('#lead_goal_update').val(data.lead_goal);
        modal.find('#delivered_lead_update').val(data.delivered_lead);
        modal.find('#undelivered_lead_update').val(data.undelivered_lead);
        modal.find('#pending_lead_update').val(data.pending_lead);
        modal.find('#extra_lead_update').val(data.extra_lead);
        modal.find('#generated_lead_update').val(data.generated_lead);
   
        // Handle delivery days checkboxes
        var deliveryDaysArray = data.delivery_days.split(',');
        modal.find('input[name="delivery_days[]"]').each(function() {
            $(this).prop('checked', deliveryDaysArray.includes($(this).val()));
        });
   
        // Populate multi-select elements
        var setMultiSelectValues = function(selector, values) {
            var valuesArray = values.split(',');
            var select = modal.find(selector);
            select.val(valuesArray).trigger('change');
        };
   
        setMultiSelectValues('#country_select_update', data.country);
        setMultiSelectValues('#company_size_select_update', data.company_size);
        setMultiSelectValues('#job_title_select_update', data.job_title);
        setMultiSelectValues('#job_level_select_update', data.job_level);
        setMultiSelectValues('#industry_update', data.industry);
   
        // Set selected value for custom question
        modal.find('#custm_que_update').val(data.custm_que);
   
        // Set selected value for camp_status
        modal.find('#camp_status_update').val(data.camp_status_update);
    });
   });
   
</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap JS -->
