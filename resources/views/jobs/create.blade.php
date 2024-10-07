<x-layout>
  <x-slot name="title">Créer un emploi</x-slot>

  <div class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-3xl">
    <h2 class="text-4xl text-center font-bold mb-4"> Créer une Offre d'Emploi</h2>
    <form  method="POST"
           action="{{ route('jobs.store') }}"
           enctype="multipart/form-data"
    >
      @csrf
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">Info sur le Poste</h2>

      <x-inputs.text id="title" name="title" label="Titre" placeholder="Ingénieur Software" />

      <x-inputs.text-area id="description" name="description" label="Description" placeholder="Nous recherchons un développeur de logiciels compétent et motivé pour rejoindre notre équipe de développement en pleine croissance...."/>

      <x-inputs.text id="salary" name="salary" type="number" label="Salaire" placeholder="90000" />

      <x-inputs.text-area id="requirements" name="requirements" label="Formation" placeholder="Baccalauréat en informatique"/>

      <x-inputs.text-area id="benefits" name="benefits" label="Avantages" placeholder="Assurance maladie, 401k, télétravail possible"/>

      <x-inputs.text id="tags" name="tags" label="Tags (séparés par des virgules)" placeholder="developpement,code,java,python" />

      <x-inputs.select
        id="job_type"
        name="job_type"
        label="Type de Poste"
        value="{{ old('job_type') }}"
        :options="['Full-Time' => 'Full-Time', 'Part-Time' => 'Part-Time', 'Contract' => 'Contract', 'Temporary' => 'Temporary', 'Internship' => 'Internship', 'Volunteer' => 'Volunteer', 'On-Call' => 'On-Call']"
      />

      <x-inputs.select
        id="remote"
        name="remote"
        label="Télétravail"
        :options="[0 => 'Non', 1 => 'Oui']"
      />

      <x-inputs.text id="address" name="address" label="Adresse" placeholder="123 Rue du Dev" />

      <x-inputs.text id="city" name="city" label="Ville" placeholder="Nantes" />

      <x-inputs.text id="state" name="state" label="Région" placeholder="PDL" />

      <x-inputs.text id="zipcode" name="zipcode" label="Code Postal" placeholder="12201" />

      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">Info Entreprise</h2>

      <x-inputs.text id="company_name" name="company_name" label="Nom Entreprise" placeholder="Entrer nom entreprise" />

      <x-inputs.text-area id="company_description" name="company_description" label="Description Entreprise" placeholder="Entrer description entreprise"/>

      <x-inputs.text id="company_website" name="company_website" type="url" label="Website Entreprise" placeholder="Entrer website" />

      <x-inputs.text id="contact_phone" name="contact_phone" label="Contact Tél." placeholder="Entrer n° de Téléphone" />

      <x-inputs.text id="contact_email" type="email" name="contact_email" label="Contact Email" placeholder="Email de réception des candidatures" />

      <x-inputs.file id="company_logo" name="company_logo" label="Logo Entreprise" />

      <button
        type="submit"
        class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
      >
        Enregistrer
      </button>
    </form>
  </div>
</x-layout>
