# facelesslog

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT) [![PHP Composer](https://github.com/Ananiaslitz/facelesslog/actions/workflows/php.yml/badge.svg?branch=main)](https://github.com/Ananiaslitz/facelesslog/actions/workflows/php.yml) ![GitHub tag (latest by date)](https://img.shields.io/github/v/tag/ananiaslitz/facelesslog) [![codecov](https://codecov.io/github/Ananiaslitz/facelesslog/graph/badge.svg?token=JYXF8YXJXA)](https://codecov.io/github/Ananiaslitz/facelesslog)


![Noppera-bo](https://img1.ak.crunchyroll.com/i/spire3/de447019cc8e62a60cf27e1939ea039a1630666276_main.jpg)

Inspirado na lenda japonesa do Noppera-bō, que descreve um rosto sem características distintas, surge a biblioteca "facelesslog". Seu propósito é ocultar ou anonimizar informações sensíveis nos registros, alinhando-se às preocupações contemporâneas sobre a privacidade dos usuários. Em um mundo onde a segurança dos dados é essencial, essa biblioteca oferece uma ferramenta útil para proteger informações valiosas em logs.

### Como utilizar a biblioteca "facelesslog":

Para instalar a biblioteca em seu projeto, utilize o gerenciador de pacotes Composer executando o seguinte comando no terminal:

```bash
composer require ananiaslitz/facelesslog
```
## Características
- Flexibilidade: Fácil de integrar com qualquer aplicação PHP.
- Configuração Customizável: Suporta configuração personalizada para ativar/desativar detectores e anonimizadores específicos.
- Singleton/Factory Pattern: Implementação eficiente para garantir a gestão otimizada de recursos.
- Mapeamento Detector-Anonimizador: Eficiência aprimorada com anonimizadores mapeados para detectores específicos.
- Suporte a Testes Unitários: Compatível com PHPUnit para testes confiáveis e robustos.
- Logging de Erros e Exceções: Registra erros e exceções para manutenção e monitoramento fáceis.
- Documentação e Exemplos: Documentação detalhada e exemplos práticos para facilitar o uso.
- Compatibilidade com Frameworks: Integrações disponíveis para frameworks populares como Laravel e Symfony.
## Configuração
Aqui está um exemplo de como você pode configurar e usar o facelesslog:

```php
// Exemplo de uso do FacelessLogger
$logger = FacelessLogger::getInstance();

// Adicionar detectores e anonimizadores conforme necessário
$logger->addDetector(new EmailDetector(), new EmailAnonymizer());
// ...

// Processar uma mensagem
$message = "User email is user@example.com";
$anonymizedMessage = $logger->processMessage($message);

echo $anonymizedMessage; // Saída será uma versão anonimizada da mensagem
```

## Criação de Detectores e Anonimizadores Customizados
A biblioteca facelesslog foi projetada com flexibilidade em mente, permitindo que os usuários ampliem sua funcionalidade de acordo com suas necessidades específicas. Para criar seus próprios Detectores e Anonimizadores, basta implementar as interfaces DetectorInterface e AnonymizerInterface.

#### Implementando a DetectorInterface
A DetectorInterface é uma interface simples que requer a implementação do método detect, que retorna um booleano. Este método é responsável por verificar se uma mensagem contém um certo tipo de informação sensível que você deseja detectar.

```php
class CustomDetector implements DetectorInterface
{
    public function detect(string $message): bool
    {
        // Lógica para detectar uma informação específica na mensagem
    }
}
```
#### Implementando a AnonymizerInterface
A AnonymizerInterface também é uma interface direta que exige a implementação do método anonymize. Este método deve retornar a mensagem com as informações sensíveis anonimizadas ou ocultadas.
```php
class CustomAnonymizer implements AnonymizerInterface
{
    public function anonymize(string $message): string
    {
        // Lógica para anonimizar informações sensíveis na mensagem
    }
}
```

## Contribuição
Sua contribuição é bem-vinda! Se você deseja melhorar a facelesslog, sinta-se à vontade para fazer um fork do repositório e enviar suas pull requests. Para bugs, questões e discussões, por favor, use a seção de issues do GitHub.

## Licença
Distribuído sob a licença MIT. Veja LICENSE para mais informações.

