from django.contrib import admin
from .models import GrantProviderT
from .models import GrantProviderTargetT
from .models import GrantT

admin.site.register(GrantProviderT)
admin.site.register(GrantProviderTargetT)
admin.site.register(GrantT)