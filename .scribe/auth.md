# Authenticating requests

To authenticate requests, include an **`Authorization`** header with the value **`"Bearer Bearer {YOUR_SANCTUM_TOKEN}"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

Utilisez le token obtenu via <code>POST /api/v1/auth/login</code> et envoyez-le dans l'en-tête <code>Authorization: Bearer {token}</code>.
