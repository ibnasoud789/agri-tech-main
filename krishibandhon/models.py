from django.db import models

class Advisor(models.Model):
    advisor_id = models.CharField(db_column='Advisor ID', primary_key=True, max_length=7) 
    fname = models.TextField()
    mname = models.TextField()
    lname = models.TextField()

    class Meta:
        managed = False
        db_table = 'advisor'


class AdvisorExpertise(models.Model):
    advisor_id = models.OneToOneField(Advisor, models.DO_NOTHING, db_column='Advisor ID', primary_key=True)  
    expertise = models.CharField(db_column='Expertise', max_length=30) 
    class Meta:
        managed = False
        db_table = 'advisor expertise'
        unique_together = (('advisor_id', 'expertise'),)


class FarmerCropnameT(models.Model):
    farmer = models.OneToOneField('FarmerT', models.DO_NOTHING, db_column='Farmer_ID', primary_key=True) 
    cropname = models.CharField(db_column='Cropname', max_length=30)

    class Meta:
        managed = False
        db_table = 'farmer_cropname_t'
        unique_together = (('farmer', 'cropname'),)


class FarmerT(models.Model):
    farmer = models.OneToOneField('User', models.DO_NOTHING, db_column='Farmer_ID', primary_key=True) 
    fname = models.CharField(max_length=20)
    mname = models.CharField(max_length=20, blank=True, null=True)
    lname = models.CharField(max_length=20, blank=True, null=True)
    landsize = models.TextField()

    class Meta:
        managed = False
        db_table = 'farmer_t'


class FeedbackT(models.Model):
    user_id = models.CharField(db_column='user_ID', primary_key=True, max_length=7)  
    feedback_number = models.CharField(max_length=5)
    rating = models.IntegerField()
    comment = models.TextField()

    class Meta:
        managed = False
        db_table = 'feedback_t'
        unique_together = (('user_id', 'feedback_number'),)


class FinancialServiceProviderT(models.Model):
    fspid = models.OneToOneField('User', models.DO_NOTHING, db_column='FSPid', primary_key=True)  
    name = models.CharField(max_length=100)
    l_field = models.TextField(db_column='L?')  
    ip_field = models.TextField(db_column='IP?')  
    g_field = models.TextField(db_column='G?')  
    i_field = models.TextField(db_column='I?') 

    class Meta:
        managed = False
        db_table = 'financial_service_provider_t'

    def __str__(self):
        return str(self.fspid)


class GrantProviderT(models.Model):
    grant_provider = models.OneToOneField(FinancialServiceProviderT, models.CASCADE, db_column='Grant_provider_ID', primary_key=True) 
    eligibility_criteria = models.TextField(db_column='Eligibility_criteria') 
    minimum_amount = models.DecimalField(db_column='Minimum_amount', max_digits=10, decimal_places=0)  
    maximum_amount = models.DecimalField(db_column='Maximum_amount', max_digits=10, decimal_places=0)  

    class Meta:
        managed = False
        db_table = 'grant_provider_t'
    
    def __str__(self):
        return str(self.grant_provider)


class GrantProviderTargetT(models.Model):
    grant_provider = models.OneToOneField(GrantProviderT, models.CASCADE, db_column='Grant_provider_ID', primary_key=True) 
    target_beneficiaries = models.CharField(db_column='Target_beneficiaries', max_length=40) 

    class Meta:
        managed = False
        db_table = 'grant_provider_target_t'
        unique_together = (('grant_provider', 'target_beneficiaries'),)


class GrantT(models.Model):
    grant_provider = models.ForeignKey(GrantProviderT, models.CASCADE, db_column='Grant_provider_ID')  
    grant_id = models.CharField(db_column='Grant_ID', primary_key=True, max_length=5)  
    grant_amount = models.DecimalField(db_column='Grant_amount', max_digits=10, decimal_places=0)  
    start_date = models.DateField(db_column='Start_date') 
    end_date = models.DateField(db_column='End_date') 
    farmer = models.ForeignKey(FarmerT, models.DO_NOTHING, db_column='Farmer_id')

    class Meta:
        managed = False
        db_table = 'grant_t'


class InsuranceProviderT(models.Model):
    insurance_provider = models.OneToOneField(FinancialServiceProviderT, models.DO_NOTHING, primary_key=True)
    premium_rate = models.DecimalField(max_digits=4, decimal_places=2)

    class Meta:
        managed = False
        db_table = 'insurance_provider_t'


class InsuranceT(models.Model):
    farmer = models.ForeignKey(FarmerT, models.DO_NOTHING)
    insurance_id = models.CharField(primary_key=True, max_length=5)
    policy_type = models.CharField(max_length=20)
    effective_date = models.DateTimeField()
    coverage_amount = models.IntegerField()
    premium_amount = models.IntegerField()
    policy_period = models.TextField()
    payment_frequency = models.TextField()
    payment_method = models.TextField()
    insurance_provider = models.ForeignKey(InsuranceProviderT, models.DO_NOTHING)

    class Meta:
        managed = False
        db_table = 'insurance_t'


class InvestmentT(models.Model):
    farmer = models.ForeignKey(FarmerT, models.DO_NOTHING, db_column='Farmer_ID')  
    investor = models.ForeignKey('InvestorT', models.DO_NOTHING, db_column='Investor_ID')  
    investment_id = models.CharField(db_column='Investment_ID', primary_key=True, max_length=5)  
    amount = models.IntegerField(db_column='Amount') 
    start_date = models.DateField(db_column='Start_date')  
    end_date = models.DateField(db_column='End_date') 

    class Meta:
        managed = False
        db_table = 'investment_t'


class InvestorT(models.Model):
    investor = models.OneToOneField(FinancialServiceProviderT, models.DO_NOTHING, db_column='Investor_ID', primary_key=True) 

    class Meta:
        managed = False
        db_table = 'investor_t'


class Loan(models.Model):
    loan_id = models.CharField(db_column='Loan_ID', primary_key=True, max_length=5)  
    receiving_date = models.DateTimeField()
    amount = models.IntegerField()
    interest_rate = models.DecimalField(max_digits=10, decimal_places=0)
    return_date = models.DateTimeField()
    farmer = models.ForeignKey(FarmerT, models.DO_NOTHING, db_column='Farmer_ID')  
    loan_provider = models.ForeignKey('LoanProvider', models.DO_NOTHING, db_column='Loan_Provider_ID') 

    class Meta:
        managed = False
        db_table = 'loan'


class LoanProvider(models.Model):
    loanprovider_id = models.CharField(db_column='LoanProvider_ID', primary_key=True, max_length=7)  
    eligibility_criteria = models.TextField()
    repayment_period = models.DateTimeField()
    application_fee = models.TextField()

    class Meta:
        managed = False
        db_table = 'loan_provider'


class LoanProviderLoanType(models.Model):
    loanprovider = models.OneToOneField(LoanProvider, models.DO_NOTHING, db_column='LoanProvider_ID', primary_key=True) 
    loan_type = models.CharField(max_length=50)

    class Meta:
        managed = False
        db_table = 'loan_provider_loan_type'
        unique_together = (('loanprovider', 'loan_type'),)


class User(models.Model):
    userid = models.CharField(db_column='userID', primary_key=True, max_length=7)  
    area = models.TextField(db_column='Area')  
    city = models.TextField()
    postcode = models.IntegerField()
    contact_number = models.TextField()
    user_type = models.TextField()

    class Meta:
        managed = False
        db_table = 'user'

    def __str__(self):
        return str(self.userid)