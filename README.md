# Veloci Lumen
A lumen flavoured extension of Veloci Framework.

### The philosophy behind
Veloci are not trying to be yet another PHP framework. Veloci is a *meta-framework*,
that means it tries to abstract the concept of a framework, making available interfaces for several common frameworks features (like the *Dependency Injection Container*, *Persistency*, *Caching*, etc...) and then using as implementation real frameworks or existing libraries. This gives us several advantages:

* Let the developers focus on the business logic only, without losing time in the common things
* Working with the interfaces allows switching the implementation easily
* Together with the point above, a framework-agnostic approach avoid to get stuck in a specific framework version. If a new framework or library pops out, and we want to use it for our project, we don't need to reimplement everything from scratch, but just change the Framework Adapter implementation.
