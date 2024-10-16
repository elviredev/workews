<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta
    name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Workews Candidatures</title>
</head>
<body>
  <p>Vous avez reçu une nouvelle candidature pour votre offre d'emploi.</p>
  <p><strong>Offre d'emploi: </strong>{{ $job->title }}</p>
  <p><strong>Détails de la candidature:</strong></p>
  <p><strong>Nom et prénom: </strong> {{ $candidature->full_name }}</p>
  <p><strong>Téléphone: </strong> {{ $candidature->contact_phone }}</p>
  <p><strong>Email: </strong> {{ $candidature->contact_email }}</p>
  <p><strong>Message: </strong> {{ $candidature->message }}</p>
  <p><strong>Ville: </strong> {{ $candidature->location }}</p>

  <p>Connectez-vous à votre compte Workews pour consulter la candidature. </p>
</body>
</html>
