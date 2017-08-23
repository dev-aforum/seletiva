<section  id="inscricao">
  <div class="container">
    <div class="row">

      <h2 class="subtitle">Inscreva-se</h2>
        <!-- formulário de inscrição -->
        <form class="form" id="form_inscription" name="form_inscription"  method="post"  enctype="multipart/form-data">

          <!-- envio de imagens -->
          <fieldset id="form_upload">

          <h3 class="subtitle2">Fotos</h3>
          <p>Primeiro, adicione uma foto sua</p>

          <div class="form_upload_img_imagePreviewContainer">
            <label  class="form_fakeButton form_upload_img_label text" for="form_inscription_imgup1" id="form_upload_button_fakeButton1">Adcionar foto</label>
            <input class="form_upload" type="file" name="photo" id="form_inscription_imgup1" alt="Foto de corpo">
            <div class="form_upload_img_imagePreview" id="form_inscription_imgPreview1"></div>
          </div>

          <!-- <div class="form_upload_img_imagePreviewContainer">
            <label class="form_upload_img_label form_fakeButton" for="form_inscription_imgup2" id="form_upload_button_fakeButton2">Adcionar foto de corpo</label>
            <input data-validation="required" class="form_upload" type="file" name="photo_2" id="form_inscription_imgup2" alt="Foto de corpo">
            <div class="form_upload_img_imagePreview" id="form_inscription_imgPreview2"></div>
          </div> -->

            <!-- <div class="form_inscription_imgup_displayArea">
            </div> -->

          </fieldset> <!-- final do fieldset de envio de imagens -->
          <!-- informações de contato -->
          <fieldset class="form_field" id="form_inscription_field">
            <h3 class="subtitle2">Dados</h3>
            <p>Agora precisamos de alguns dados pessoais</p>
            <input type="text" name="user_name" class="required" placeholder="Nome">
            <input data-validation="email" type="text" class="required" name="email" id="form_inscription_email" placeholder="Email">
            <input type="text" name="telephone" class="required" id="form_inscription_telephone" placeholder="Telefone com DDD">
            <input type="text" name="celphone"  class="required" id="form_inscription_celphone" placeholder="Celular com DDD" >
            <select name="state"  id="form_inscription_state" class="select2  box_sel_d">
              <option value ="" >Estado</option>
              <option value="Acre"> Acre </option>
              <option value="Alagoas"> Alagoas </option>
              <option value="Amapá"> Amapá	</option>
              <option value="Amazonas"> Amazonas	</option>
              <option value="Bahia"> Bahia	</option>
              <option value="Ceará"> Ceará	</option>
              <option value="Distrito Federal"> Distrito Federal </option>
              <option value="Espírito Santo"> Espírito Santo	</option>
              <option value="Goiás"> Goiás	</option>
              <option value="Maranhão"> Maranhão	</option>
              <option value="Mato Grosso"> Mato Grosso	</option>
              <option value="Mato Grosso do Sul"> Mato Grosso do Sul	</option>
              <option value="Minas Gerais"> Minas Gerais	</option>
              <option value="Pará"> Pará	</option>
              <option value="Paraíba"> Paraíba	</option>
              <option value="Paraná"> Paraná	</option>
              <option value="Pernambuco"> Pernambuco	</option>
              <option value="Piauí"> Piauí	</option>
              <option value="Rio de Janeiro"> Rio de Janeiro </option>
              <option value="Rio Grande do Norte"> Rio Grande do Norte	</option>
              <option value="Rio Grande do Sul"> Rio Grande do Sul </option>
              <option value="Rondônia"> Rondônia	</option>
              <option value="Roraima"> Roraima	</option>
              <option value="Santa Catarina"> Santa Catarina	</option>
              <option value="São Paulo"> São Paulo	</option>
              <option value="Sergipe"> Sergipe	</option>
              <option value="Tocatins"> Tocantins  </option>
            </select>
            <input data-validation="required" type="text" name="city"  placeholder="Cidade">
            <input data-validation="required" type="text" name="district"  placeholder="Bairro">
            <input data-validation="required" type="text" name="adress"   placeholder="Endereço">
            <select id="form_inscription_age" name="age" placeholder="Idade"  class="required box_sel_d" >
              <option value ="">Idade</option>
            </select>

            <input data-validation="required" type="text" id="tutorName" class="form_inscription_tutorData"  name="tutorName"placeholder="Nome responsável" style="display: none;">

            <select name="gender" class="required box_sel_d" id="form_inscription_gender">
              <option value ="">Gênero</option>
              <option value="m" class="form_inscription_masc_hidden">Masculino</option>
              <option value="f" class="form_inscription_fem_hidden">Feminino</option>
            </select>
          </fieldset>

            <input type="hidden" id="indicacao" name="indicacao" value="8"/>
            <input type="hidden" id="numero_unidade" name="numero_unidade" value="7"/>

        <button id="btn-sm-scouter" name="button" class="subtitle3 btn-sm" onclick="_gaq.push([‘_trackEvent’, ‘Seletiva’, ‘clique’, ‘Joinville’, true]);">Enviar</button>

      </form>
    </div>
  </div>
</section>
