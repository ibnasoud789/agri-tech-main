from django.urls import path, include
from . import views

urlpatterns = [
    path('', views.provider_list, name = 'list'),
    path('<int:id>/', views.provider_form, name = 'provider_update'),
    path('form/', views.provider_form, name = 'form'),
    path('delete/<int:id>/', views.provider_delete, name = 'provider_delete'),
    path('home/', views.home, name='home'),
    path('targetlist/', views.target_list, name= 'target_list'),
    path('grantlist/', views.grant_list, name= 'grant_list'),
    path('targetform/', views.target_form, name = 'target_form'),
    path('grantform/', views.grant_form, name = 'grant_form'),
    path('tup/<int:id>/', views.target_form, name = 'target_update'),
    path('delete/<int:id>/', views.target_delete, name = 'target_delete'),
    path('gup/<int:id>/', views.grant_form, name = 'grant_update'),
    path('delete/<int:id>/', views.grant_delete, name = 'grant_delete'),
]