# SOLID.md

## How SOLID Applied in the code

**Single Responsibility Principle (SRP):**
`LogOrderNotifier` has exactly one reason to change: how a notification message gets written to the log. It doesn't decide when a notification should be sent

**Open/Closed Principle (OCP):**
We are open for extending but not for modifying existing tested functionality like in adding new shipping method, we create new class that implements `ShippingMethodInterface` and just add new line in `ShippingMethodsProvider` to register class

**Liskov Substitution Principle (LSP):**
Every class implementing `ShippingMethodInterface` can be substituted for one another without any problem `ShippingMethodsRegistry::get()`
returns a value typed only as `ShippingMethodInterface` without ever checking which concrete class it actually received

**Interface Segregation Principle (ISP);**
`ShippingMethodInterface` exposes only calculate() and label() — nothing a calculator doesn't need

**Dependency Inversion Principle (DIP):**
In service `OrderStatusTransitionService` it depends only on the `OrderNotifier` interface not the implemented class `LogOrderNotifier`
so high-level don't depend on low-level instead depend on interfaces

## How SOLID Applied in Unit Tests for Shipping Calculators: Why I used 'ShippingContext' instead of 'Order'

**Open/Closed Principle (OCP):**
If a future shipping method needs a new factor beyond `weightGrams` and `country`, that field is added directly to `ShippingContext`. Existing calculators don't need to change, they simply continue to ignore fields they don't use, the same way
`FlatRateShippingCalculator` already ignores both existing fields

**Interface Segregation Principle (ISP):**
The calculator classes only need two fields to calculate a shipping cost. There's no need to expose them to the full `Order` model with all its unrelated fields instead using `ShippingContext` with only two fields, and no need to depend on the database

**Dependency Inversion Principle (DIP):**
High-level modules (the calculators, which hold the business logic) shouldn't depend directly on low-level modules `Order` instead `ShippingContext` is a plain, database-free data object instead of the model

