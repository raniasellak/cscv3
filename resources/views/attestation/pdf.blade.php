<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Attestation</title>
<style>
  @page {
      size: 800pt 500pt;

    margin: 0;
  }

  body {
  margin: 0;
  font-family: DejaVu Sans, sans-serif;
  background-color: #fff; /* avant: #f5f5f5 */
  color: #333;
}


  .certificate-container {
    position: relative;
    width: 100%;
    height: 100vh;
    background: #fff;
  }

  .left-bar,
  .right-bar {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 50px;
    background: #f4b63e;
  }

  .left-bar {
    left: 0;
    border-left: 50px solid #2d2d2d;
  }

  .right-bar {
    right: 0;
    border-right: 50px solid #2d2d2d;
  }

  .certificate {
    position: relative;
    width: calc(100% - 40px);
    margin: 0 auto;
    padding: 30px 0;
    text-align: center;
  }

  .title {
    font-size: 24pt;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .subtitle {
    margin-bottom: 20px;
  }

  .name {
    font-size: 28pt;
    font-weight: bold;
    color: #f4b63e;
    margin: 20px 0;
  }

  .content {
    font-size: 14pt;
    margin: 20px auto;
    width: 70%;
    line-height: 1.6;
  }

  .logo {
    font-size: 30px;
    margin: 30px 0;
  }

  .signatures {
    display: flex;
    justify-content: space-around;
    margin-top: 40px;
    font-size: 12pt;
  }

  .signatures strong {
    display: block;
    margin-bottom: 5px;
  }
</style>
</head>
<body>
  <div class="certificate-container">
    <div class="left-bar"></div>
    <div class="right-bar"></div>
    <div class="certificate">
      <div class="title">ATTESTATION DE PARTICIPATION</div>
      Nous avons le plaisir d’attester que
      <div class="name">{{ strtoupper($nom) }}</div>
      <div class="content">
        a fait preuve d'un engagement et d'une implication exceptionnels lors de la formation intitulée
        <strong>{{ $formation->title }}</strong>, qui s'est déroulé
        <strong>{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</strong>.<br>
        Sa participation active et son intérêt constant ont été appréciés tout au long de la session. Nous saluons sa présence qui a enrichi cette expérience collective.
      </div>
      <div class="logo">◆◆<br>◆◆</div>
      <div class="signatures">
        <div>
          <strong>Hatim</strong>
          Présidente du club
        </div>
      </div>
    </div>
  </div>
</body>
</html>
