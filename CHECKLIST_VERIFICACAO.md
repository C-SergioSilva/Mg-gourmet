# ✅ Checklist de Verificação - MG-Gourmet

## 🎯 Como Testar Sua Aplicação

Este checklist vai te ajudar a verificar se tudo está funcionando corretamente no seu projeto MG-Gourmet.

---

## 📋 PARTE 1 - VERIFICAÇÃO DO BACKEND (Laravel)

### 1.1 Servidor Laravel Rodando
```powershell
# No diretório: C:\documentos\formacoes\php\mg-gourmet\backend\mg-gourmet-api
php artisan serve
```

**✅ Verificar:**
- [ ] Servidor iniciou na porta 8000
- [ ] Sem erros no terminal
- [ ] Mensagem: "Laravel development server started: http://127.0.0.1:8000"

### 1.2 Banco de Dados SQLite
```powershell
# Verificar se arquivo existe
ls database/database.sqlite

# Executar migrations
php artisan migrate

# Executar seeders
php artisan db:seed
```

**✅ Verificar:**
- [ ] Arquivo `database.sqlite` criado
- [ ] Migrations executadas sem erro
- [ ] Seeders executados (usuário admin + produto criados)

### 1.3 Endpoints da API
```powershell
# Testar endpoint público (listar produtos)
Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/products" -Method GET

# Testar endpoint específico (produto 1)
Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/products/1" -Method GET

# Testar login
$loginData = @{email="admin@mg-gourmet.com"; password="password123"} | ConvertTo-Json
Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/auth/login" -Method POST -Body $loginData -ContentType "application/json"
```

**✅ Verificar:**
- [ ] `/api/products` retorna lista de produtos
- [ ] `/api/products/1` retorna produto específico
- [ ] `/api/auth/login` retorna token JWT
- [ ] Status HTTP 200 para sucesso

### 1.4 Upload de Arquivos
```powershell
# Verificar link storage
php artisan storage:link
```

**✅ Verificar:**
- [ ] Link simbólico criado: `public/storage -> ../storage/app/public`
- [ ] Diretório `storage/app/public` existe

---

## 📋 PARTE 2 - VERIFICAÇÃO DO FRONTEND (Angular)

### 2.1 Servidor Angular Rodando
```powershell
# No diretório: C:\documentos\formacoes\php\mg-gourmet\frontend\mg-gourmet-app
ng serve --port 4200
```

**✅ Verificar:**
- [ ] Servidor iniciou na porta 4200
- [ ] Compilação sem erros
- [ ] Mensagem: "Application bundle generation complete"

### 2.2 Página Inicial Carregando
**Abrir navegador:** `http://localhost:4200`

**✅ Verificar:**
- [ ] Página carrega sem erros
- [ ] Bootstrap CSS aplicado
- [ ] Navigation bar visível
- [ ] Botões "Login" e "Admin" presentes

### 2.3 Comunicação com API
**No navegador (F12 > Network):**

**✅ Verificar:**
- [ ] Requisição GET para `http://127.0.0.1:8000/api/products`
- [ ] Status 200 OK
- [ ] Resposta JSON com produtos
- [ ] CORS configurado (sem erros de Cross-Origin)

---

## 📋 PARTE 3 - FLUXO DE AUTENTICAÇÃO

### 3.1 Página de Login
**Navegar:** `http://localhost:4200/login`

**✅ Verificar:**
- [ ] Formulário de login carregado
- [ ] Campos: email, password
- [ ] Validações funcionando (campos obrigatórios)
- [ ] Botão "Entrar" presente

### 3.2 Processo de Login
**Dados de teste:**
- Email: `admin@mg-gourmet.com`
- Senha: `password123`

**✅ Verificar:**
- [ ] Login bem-sucedido
- [ ] Token salvo no localStorage
- [ ] Redirecionamento para área admin
- [ ] Mensagem de sucesso (se implementada)

### 3.3 Área Administrativa
**URL após login:** `http://localhost:4200/admin`

**✅ Verificar:**
- [ ] Página admin carregada
- [ ] Lista de produtos exibida
- [ ] Botões CRUD presentes
- [ ] Acesso protegido (sem token = redirecionamento)

### 3.4 Logout
**✅ Verificar:**
- [ ] Token removido do localStorage
- [ ] Redirecionamento para página inicial
- [ ] Não consegue acessar /admin após logout

---

## 📋 PARTE 4 - FUNCIONALIDADES CRUD

### 4.1 Listar Produtos (READ)
**✅ Verificar:**
- [ ] Produtos exibidos em cards/lista
- [ ] Informações: nome, descrição, preço
- [ ] Imagens carregando (se houver)
- [ ] Tratamento de erro para imagens quebradas

### 4.2 Criar Produto (CREATE)
**Dados de teste:**
- Nome: "Produto Teste"
- Descrição: "Descrição do produto teste"
- Preço: 25.50

**✅ Verificar:**
- [ ] Formulário de criação funcional
- [ ] Validações client-side
- [ ] Produto criado na API
- [ ] Lista atualizada automaticamente
- [ ] Upload de imagem (opcional)

### 4.3 Editar Produto (UPDATE)
**✅ Verificar:**
- [ ] Formulário pré-preenchido
- [ ] Alterações salvas na API
- [ ] Lista atualizada
- [ ] Apenas proprietário pode editar

### 4.4 Deletar Produto (DELETE)
**✅ Verificar:**
- [ ] Confirmação antes de deletar
- [ ] Produto removido da API
- [ ] Lista atualizada
- [ ] Apenas proprietário pode deletar

---

## 📋 PARTE 5 - SEGURANÇA E VALIDAÇÕES

### 5.1 Proteção de Rotas
**Teste sem estar logado:**

**✅ Verificar:**
- [ ] `/admin` redireciona para `/login`
- [ ] Mensagem de "não autorizado" (se implementada)
- [ ] Rotas públicas funcionam normalmente

### 5.2 Validações Backend
**Tentar criar produto com dados inválidos:**
```json
{
  "name": "",
  "price": -10,
  "description": ""
}
```

**✅ Verificar:**
- [ ] API retorna erro 400 (Bad Request)
- [ ] Mensagens de validação específicas
- [ ] Produto não é criado no banco

### 5.3 Validações Frontend
**✅ Verificar:**
- [ ] Campos obrigatórios destacados
- [ ] Mensagens de erro em tempo real
- [ ] Botão desabilitado se form inválido
- [ ] Validação de email format

### 5.4 Autorização
**Com usuário logado:**

**✅ Verificar:**
- [ ] Token JWT enviado automaticamente (Authorization header)
- [ ] Apenas próprios produtos podem ser editados/deletados
- [ ] API retorna 403 para recursos não autorizados

---

## 📋 PARTE 6 - EXPERIÊNCIA DO USUÁRIO

### 6.1 Responsividade
**Testar em diferentes tamanhos:**

**✅ Verificar:**
- [ ] Desktop (1920x1080)
- [ ] Tablet (768x1024)
- [ ] Mobile (375x667)
- [ ] Layout se adapta corretamente
- [ ] Navegação funcional em todos os tamanhos

### 6.2 Loading States
**✅ Verificar:**
- [ ] Indicador de carregamento durante requisições
- [ ] Botões desabilitados durante envio
- [ ] Feedback visual adequado

### 6.3 Error Handling
**Testar com backend desligado:**

**✅ Verificar:**
- [ ] Mensagens de erro amigáveis
- [ ] Aplicação não quebra
- [ ] Possibilidade de retry

### 6.4 Performance
**✅ Verificar:**
- [ ] Páginas carregam rapidamente
- [ ] Sem memory leaks (F12 > Performance)
- [ ] Imagens otimizadas
- [ ] Lazy loading (se implementado)

---

## 📋 PARTE 7 - ESTRUTURA DO CÓDIGO

### 7.1 Organização Laravel
**Verificar estrutura:**
```
app/
├── Domain/Product/           # ✅ Entidades de negócio
├── Infrastructure/           # ✅ Implementações técnicas
├── Application/Services/     # ✅ Casos de uso
└── Http/Controllers/Api/     # ✅ Controllers da API
```

### 7.2 Organização Angular
**Verificar estrutura:**
```
src/app/
├── components/              # ✅ Componentes UI
├── services/               # ✅ Serviços de negócio
├── models/                 # ✅ Interfaces TypeScript
└── guards/                 # ✅ Proteção de rotas
```

### 7.3 Configurações
**✅ Verificar arquivos:**
- [ ] `.env` (Laravel) - configurações de ambiente
- [ ] `environment.ts` (Angular) - configurações do app
- [ ] `angular.json` - configurações do projeto
- [ ] `composer.json` - dependências PHP
- [ ] `package.json` - dependências Node.js

---

## 🐛 TROUBLESHOOTING COMUM

### Problema: "CORS Error"
**Solução:**
```php
// config/cors.php
'allowed_origins' => ['http://localhost:4200'],
```

### Problema: "Token not found"
**Verificar:**
- [ ] JWT_SECRET configurado no .env
- [ ] Token sendo enviado no header Authorization
- [ ] Token válido e não expirado

### Problema: "Database not found"
**Solução:**
```powershell
touch database/database.sqlite    # Criar arquivo
php artisan migrate              # Executar migrations
```

### Problema: "Port already in use"
**Solução:**
```powershell
# Parar processos na porta
netstat -ano | findstr :8000
taskkill /PID <PID> /F

# Ou usar porta diferente
php artisan serve --port=8001
```

### Problema: "Module not found" (Angular)
**Solução:**
```powershell
rm -rf node_modules package-lock.json
npm install
```

---

## ✅ CHECKLIST FINAL

### Funcionalidades Básicas
- [ ] ✅ Backend Laravel rodando (porta 8000)
- [ ] ✅ Frontend Angular rodando (porta 4200)
- [ ] ✅ Banco de dados funcionando
- [ ] ✅ API endpoints respondendo
- [ ] ✅ CORS configurado

### Autenticação
- [ ] ✅ Login funcional
- [ ] ✅ JWT tokens funcionando
- [ ] ✅ Guards protegendo rotas
- [ ] ✅ Logout funcionando
- [ ] ✅ Interceptors adicionando tokens

### CRUD Produtos
- [ ] ✅ Listar produtos (público)
- [ ] ✅ Criar produto (autenticado)
- [ ] ✅ Editar produto (proprietário)
- [ ] ✅ Deletar produto (proprietário)
- [ ] ✅ Upload de imagens

### Segurança
- [ ] ✅ Validações backend
- [ ] ✅ Validações frontend
- [ ] ✅ Autorização granular
- [ ] ✅ Senhas criptografadas
- [ ] ✅ Sanitização de dados

### Interface
- [ ] ✅ Design responsivo
- [ ] ✅ Bootstrap integrado
- [ ] ✅ Navegação intuitiva
- [ ] ✅ Error handling
- [ ] ✅ Loading states

---

## 🎉 Parabéns!

Se todos os itens estão ✅, você tem uma aplicação full-stack completa e funcional!

### Próximos Desafios:
1. **Adicionar mais funcionalidades** (categorias, avaliações, carrinho)
2. **Implementar testes** (unit, integration, e2e)
3. **Melhorar performance** (caching, lazy loading)
4. **Preparar para produção** (Docker, CI/CD)
5. **Adicionar features avançadas** (PWA, WebSockets)

**Continue praticando e explorando! 🚀**